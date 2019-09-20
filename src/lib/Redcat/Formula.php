<?php

namespace Redcat;

class Formula
{
    /**
     * The columnHeadings of data we are working with (flipped)
     * @var array
     */
    private $columns;

    /**
     * The allowable operators
     * @var array
     */
    private $operators = [ '*', '-', '+', '/', '&' ];

    /**
     * The raw formula as entered by the user
     * @var string
     */
    private $raw;

    /**
     * The tokenized formula from the raw formula as entered by the user
     * @var array
     */
    private $tokens;

    /**
     * Save some values for later
     *
     * @param string $rawFormula the rawFormula as entered by the user
     * @param array $columnHeadings the columnHeadings for the data we will be working with
     * @return void
     */
    public function __construct(string $rawFormula, array $columnHeadings)
    {
        $this->raw = $rawFormula;
        $this->columns = \array_flip($columnHeadings);
        $this->parse();
    }

    /**
     * Use the formula to calculate the value for the new column
     *
     * @param array $row the row of data
     * @return array the $row with the new column value added
     */
    public function calculate(array $row)
    {
        $operator = '';
        $value = null;

        for ($i = 0; $i < \count($this->tokens); $i++) {
            $token = $this->tokens[$i];
            if (in_array($token, $this->operators)) {
                if ($operator !== '') {
                    // if multiple operators in a row, we can ignore all bu the last one, but just for fun, let's throw an exception
                    throw new \Exception(
                        "Multiple operators in a row. This is not illegal, but it makes me question whether you know what you are doing.",
                        1
                    );
                }
                // this token is an operator. save it until we get the next token
                $operator = $token;
                continue;
            } elseif (isset($this->columns[$token])) {
                // this token represents a column in the row
                $val = $row[$this->columns[$token]];
            } else {
                // token is not an operator or a column, so it must be a constant
                $val = $token;
            }
            // since I got here, $val represents the new val to be incorporated into the column value
            if ($value === null) {
                // this is the first token, so just assign val to value
                $value = $val;
            } else {
                // we have an existing value, a val, and hopefully an operator
                $value = $this->operate($value, $operator, $val);

                // we used the operator, so forget it.
                $operator = '';
            }
        }

        $row[] = $value;
        
        return $row;
    }

    /**
     * Use the formula to calculate the value for the new column
     *
     * @param array $row the row of data
     * @return array the $row with the new column added
     */
    private function operate($value, string $operator, $val)
    {
        if ($operator === '&') {
            // doesn't matter what value and val are, just glue them together
            $value .= $val;
        } else {
            // we need to make sure we are dealing with numbers
            if (\is_numeric($value) && \is_numeric($val)) {
                switch ($operator) {
                    case '*':
                        $value *= $val;
                        break;
                    case '+':
                        $value += $val;
                        break;
                    case '-':
                        $value -= $val;
                        break;
                    case '/':
                        $value = \floatval($val) == 0 ? 'NA' : $value / $val;
                        break;
                }
            } else {
                $value = 'NA';
            }
        }
        
        return $value;
    }

    /**
     * Parse the raw formula into tokens
     *
     * @return void
     */
    private function parse()
    {
        // TODO figure out a regular expression that works
        // preg_match(
        //     '/(".*")|([^ ]*)/',
        //     $this->raw,
        //     $this->tokens);
        //     return;

        // break the formula into pieces using space
        $parts = \explode(' ', $this->raw);
        $numParts = count($parts);

        // that kind of worked, but we need to glue back together any string constants
        for ($i = 0; $i < $numParts; $i += 1) {
            // setup
            $token = $parts[$i];
            $tokenLength = \strlen($parts[$i]);
            $opensString = \substr($token, 0, 1) === '"';
            $closesString = \substr($token, $tokenLength - 1, 1) === '"';
            if ($opensString && !$closesString ||
                ($opensString && $closesString && $tokenLength === 1)) {
                // start of string constant
                $token = \substr($token, 1);
                $inString = true;
                while ($inString && $i < $numParts - 1) {
                    $i++;
                    $token .= ' ' . $parts[$i];
                    $inString = \substr($token, \strlen($token) - 1, 1) !== '"';
                }
                // we patched the token back together, and should have a trailing "
                $token = \rtrim($token, '"');
            } elseif ($opensString && $closesString) {
                // this was a string constant contained in a single token
                $token = \substr($token, 1, $tokenLength - 2);
            }
            $this->tokens[] = $token;
        }
    }

    /**
     * Expose the tokens
     *
     * @return array
     */
    public function tokens() : array
    {
        return $this->tokens;
    }

}//end Formula
