<?php
namespace Classes;

/**
 * Documentation
 * 
 * @method public static array|Exception toAscii(string $str) Returns an array of all the ASCII codepoints of the argument string.
 * @method public static string|Exception asciiToString(array $orArr) Returns the string of each ASCII codepoints of the array.
 * @method private string|Exception encodeOffset(array $asciiArr, ?int $offset) Returns the string with ASCII offset.
 * @method private null|Exception checkOffset() Changes the offset to its modulo result if > 26
 * @method public string|Exception code(?int $offset = null) Returns string of Cesar coded with the optional offset
 */

class Cesar {
    private String $originalString;
    private String $codedString;
    private int $offset = 3;
    private int $originalOffset = 3;

    public function __construct(String $orStr, ?int $off = null) 
    {
        $this->originalString = strtoupper($orStr);
        // if no offset specified: applies the default offset
        is_null($off) ? $this->offset = $this->offset : $this->offset = $off;
        // checks the validity of the input offset
        $this->checkOffset();
        // saves the original input offset for print purpose
        is_null($off) ? $this->originalOffset = $this->originalOffset : $this->originalOffset = $off;
        $this->codedString = $this->code();
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getOriginalOffset(): int
    {
        return $this->originalOffset;
    }

    public function getCodedString(): string
    {
        return $this->codedString;
    }

    /**
     * Method that changes the offset to its modulo result if > 26
     * 
     *  @return null|Exception
     */
    private function checkOffset(): null|Exception
    {
        try {
            if ($this->offset > 26) {
                $this->offset %= 26;
            }

            return null;

        } catch (Exception $e) {
            return $e; 
        }
    }

    /**
     * Method that turns the argument string into an array of all its ASCII encodings.
     * 
     * @return array|Exception array of ASCII encodings of each character of the input string or Exception if an error occured
     */
    public static function toAscii(string $orStr): array|Exception
    {
        try {
            // array_map: applies a callback to each element of an array
            // str_split: converts a string to an array
            // ord is the callback: it turns a character into its ASCII encoding
            // $asciiStr is an array of every ASCII codes of the initial string
            $asciiArr = array_map('ord', str_split($orStr));

        } catch (Exception $e) {
            return $e; 
        }

        return $asciiArr;
    } // toAscii

    /**
     * Method that turns the argument array containing ASCII codes into the corresponding string.
     * 
     * @return string|Exception string of each ASCII codes of the input array or Exception if an error occured
     */
    public static function asciiToString(array $orArr): string|Exception
    {
        try {
            // chr: convert a ASCII codepoint to its corresponding character (string)
            // implode: turns the array into a string
            $asciiStr = implode(array_map('chr', $orArr));

        } catch (Exception $e) {
            return $e; 
        }

        return $asciiStr;
    } // asciiToString

    /**
     * Method that turns the argument array that contains ASCII codes to the corresponding string with the offset argument offset. 
     * 
     * @return string|Exception string with ASCII offset
     */
    private function encodeOffset(array $asciiArr, int $offset): string|Exception
    {
        try {
            // the final coded string
            (string) $offsetString = "";
            
            // we check that the character is a letter, or else the offset doesn't apply
            foreach($asciiArr as $index => $codepoint) {
                // if the character is a letter
                if ($codepoint >= 65 && $codepoint <= 90) {
                    // we add the offset to the codepoint and put it back in the array
                    $codepoint += $offset;
                    // if the new codepoint isn't a letter
                    if($codepoint > 90) {
                        // we go back to the codepoint of A and add the remaining difference between the new codepoint and Z
                        $codepoint = 64 + ($codepoint - 90);
                    }
                    $asciiArr[$index] = $codepoint;
                }
                $index++;
            }

            // converts the new ASCII codepoints to their character
            $offsetString = self::asciiToString($asciiArr);

        } catch (Exception $e) {
            return $e;  
        }

        // return the coded string
        return $offsetString;
    } // encodeOffset

    /**
     * Encodes using Cesar algorithm with optionally set offset the object string.
     * 
     * @return string|Exception string of Cesar coded with the optional offset | Exception if an error occured
     */
    public function code(?int $offset = null): string|Exception
    {
        try {
            // if no offset is set, the object offset is used
            is_null($offset) ? $offset = $this->offset : $offset = $this->checkOffset($offset);
            
            // we assign the coded string to the object property and return it
            return $this->codedString = $this->encodeOffset($this->toAscii($this->originalString), $offset);

        } catch (Exception $e) {
            return $e;  
        }
    } // code
} // Cesar