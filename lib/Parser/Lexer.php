<?php
/**
 * Lexigraphical Analyzer
 * This class breaks down iCalendar data into tokens which are then fed to the
 * parser for further processing.
 *
 * @author      Luke Visinoni <luke.visinoni@gmail.com>
 * @copyright   (c) 2014 Luke Visinoni <luke.visinoni@gmail.com>
 * @license     GNU Lesser General Public License v3 (see LICENSE file)
 */
namespace qCal\Parser;

class Lexer {

    /**
     * Token types
     */
    const ALPHA = 1;
    const NUMERIC = 2;
    const COLON = 3;
    const SEMICOLON = 4;
    const QUOTE = 5;
    const APOSTROPHE = 6;
    const COMMA = 7;
    const DASH = 8;
    const NEWLINE = 9;
    const WHITESPACE = 10;
    const CHAR = 11;
    
    protected $reader;
    
    protected $lineNo = 1;
    
    protected $charNo = 0;
    
    protected $token;
    
    protected $tokenType = -1;
    
    /**
     * @todo
     * Eventually $string will be replaced by a qCal\Parser\Reader object which
     * will allow different types of readers, but for now it is just a string
     * containing iCalendar-formatted data.
     *
     * The second parameter will be a qCal\Parser\Context object. The context
     * object is where parsers store the results of parsing the data.
     */
    public function __construct(Reader $reader/*, Context $context*/) {
    
        $this->reader = $reader;
    
    }
    
    public function getReader() {
    
        return $this->reader;
    
    }
    
    public function getLineNo() {
    
        return $this->lineNo;
    
    }
    
    public function getCharNo() {
    
        return $this->charNo;
    
    }
    
    public function getTokenType() {
    
        return $this->tokenType;
    
    }
    
    public function getToken() {
    
        return $this->token;
    
    }
    
    /**
     * @todo For now we are enforcing CR LF whether it's there or not
     */
    protected function handleNewLine($char) {
    
        $next = $this->reader->getChar();
        if (!$this->isNewLine($next)) {
            $this->reader->backUp();
        }
        return "\r\n";
    
    }
    
    public function eatAlphaChars($char) {
    
        $val = $char;
        while ($this->isAlpha($char=$this->reader->getChar())) {
            $val .= $char;
        }
        $this->reader->backUp();
        return $val;
    
    }
    
    public function nextToken() {
    
        while (!is_bool($char = $this->reader->getChar())) {
            if ($this->isNewLine($char)) {
                // if newline, swallow CR LF, CR, or LF
                // @todo RFC2445 requires CR LF
                $this->token = $this->handleNewline($char);
                $this->lineNo++;
                $this->charNo = 0;
                return $this->tokenType = self::NEWLINE;
            } else if ($this->isAlpha($char)) {
                $this->token = $this->eatAlphaChars($char);
                $this->tokenType = self::ALPHA;
            } else if ($this->isColon($char)) {
                $this->token = $char;
                $this->tokenType = self::COLON;
            } else {
                
            }
            $this->charNo += strlen($this->getToken());
            return $this->tokenType;
        }
        return false;
    
    }
    
    /**
     * Fetch the next character
    public function getChar() {
    
        if ($this->pos >= strlen($this->data)) {
            return false;
        }
        $char = substr($this->data, $this->charNo, 1);
        $this->charNo++;
        return $char;
    
    }
     */
    
    /**
     * Move on to the next token in the data
    public function nextToken() {
    
        $this->token = null;
        while (!is_bool($char = $this->getChar())) {
            if ($this->isNewLine()) {
                $this->token = $char;
                // Uncomment these once Reader object is in use
                // $this->lineNo++;
                // $this->charNo = 0;
                return ($this->tokenType = self::NEWLINE);
            } else if ($this->isAlpha()) {
                
            }
        }
    
    }
     */
    
    /**
     * Determine if current character is a newline character
     * @todo This shouldn't be public. find a new way to test it
     */
    public function isNewLine($char) {
    
        return ($char == "\n" || $char == "\r");
    
    }
    
    /**
     * Determine if current character is an alpha character
     */
    public function isAlpha($char) {
    
        return preg_match("/^[A-Za-z]+$/", $char);
    
    }
    
    /**
     * Determine if current character is an alpha character
     */
    public function isNumeric($char) {
    
        return preg_match("/^[0-9]+$/", $char);
    
    }
    
    /**
     * Determine if current character is a colon character
     */
    public function isColon($char) {
    
        return ($char == ':');
    
    }
    
    /**
     * Determine if current character is a semi-colon character
     */
    public function isSemiColon($char) {
    
        return ($char == ';');
    
    }
    
    /**
     * Determine if current character is a quote character
     */
    public function isQuote($char) {
    
        return ($char == '"');
    
    }
    
    /**
     * Determine if current character is an apostrophe character
     */
    public function isApostrophe($char) {
    
        return ($char == "'");
    
    }
    
    /**
     * Determine if current character is a comma character
     */
    public function isComma($char) {
    
        return ($char == ",");
    
    }
    
    /**
     * Determine if current character is whitespace characters
     */
    public function isWhitespace($char) {
    
        return preg_match('/^[ \t]+$/', $char);
    
    }

}