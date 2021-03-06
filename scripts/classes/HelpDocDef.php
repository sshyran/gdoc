<?php

/**
 * Description of HelpDocDef
 *
 * @author lsong
 */


class ParseTag
{
    private $_tag;
    private $_isMultiLine;
    private $_isMultiLang;
    private $_splitCont;
    private $_isMultiEntry;

    public function __construct($tag, $isMultiLine, $isMultiLang,
            $splitCont=0, $isMultiEntry=0)
    {
        $this->_tag = $tag;
        $this->_isMultiLine = $isMultiLine;
        $this->_isMultiLang = $isMultiLang;
        $this->_splitCont = $splitCont;
        $this->_isMultiEntry = $isMultiEntry;
    }
	
	public function getTag()
	{
		return $this->_tag;
	}
	
	public function isMultiLine()
	{
		return $this->_isMultiLine;
	}
	
	public function isMultiLang()
	{
		return $this->_isMultiLang;
	}
	
	public function splitCont()
	{
		return $this->_splitCont;
	}
	
	public function isMultiEntry()
	{
		return $this->_isMultiEntry;
	}
}

class HelpDocDef
{
    const TYPE_PAGE = 'PAGE';
    const TYPE_TBL = 'TBL';
    const TYPE_ITEM = 'ITEM';
    const TYPE_QA = 'QA';
    const TYPE_NAV = 'PAGENAV';
    const TYPE_HELPDOC = 'HELPDOC';
	const TYPE_TERMS = 'TERMS';

    //put your code here
    private $_def;

    public static function Get($type='')
    {
        if ( !isset($GLOBALS['_HelpDocDef_']) ) {
			$GLOBALS['_HelpDocDef_'] = new HelpDocDef();
        }
		$instance = $GLOBALS['_HelpDocDef_'];
        if ($type == '')
            return $instance->_def;
        elseif (isset($instance->_def[$type]))
            return $instance->_def[$type];
        else
            die("wrong type in HelpDocDef, abort!");
    }

	private function __construct()
    {
        $this->_def = array();
		// ParseTag($tag, $isMultiLine, $isMultiLang, $splitCont=0, $isMultiEntry=0)		
        $this->_def['ITEM'] = array(
            'ID' => new ParseTag('ID', 0, 0),
            'NAME' => new ParseTag('NAME', 0, 1),
            'NS' => new ParseTag('NS', 0, 0),
            'REQUIRED' => new ParseTag('REQUIRED', 0, 0),
            'APPLY' => new ParseTag('APPLY', 0, 0),
            'SINCE' => new ParseTag('SINCE', 0, 0),
            'SEE_ALSO' => new ParseTag('SEE_ALSO', 0, 0),
            'DESCR' => new ParseTag('DESCR', 1, 1),
            'SYNTAX' => new ParseTag('SYNTAX', 1, 1),
            'EXAMPLE' => new ParseTag('EXAMPLE', 1, 1),
            'TIPS' => new ParseTag('TIPS', 1, 1),
            'EDITTIP' => new ParseTag('EDITTIP', 1, 1, 0, 1)
            );
        $this->_def['TBL'] = array(
            'ID' => new ParseTag('ID', 0, 0),
            'NAME' => new ParseTag('NAME', 0, 1),
            'NS' => new ParseTag('NS', 0, 0),
            'DESCR' => new ParseTag('DESCR', 1, 1),
            'CONT' => new ParseTag('CONT', 1, 0, 1),
            'SEE_ALSO' => new ParseTag('SEE_ALSO', 0, 1),
            'EXAMPLE' => new ParseTag('EXAMPLE', 1, 1),
            'TIPS' => new ParseTag('TIPS', 1, 1),
            'EDITTIP' => new ParseTag('EDITTIP', 1, 1, 0, 1)
            );
        $this->_def['PAGE'] = array(
            'ID' => new ParseTag('ID', 0, 0),
            'NAME' => new ParseTag('NAME', 0, 1),
            'NS' => new ParseTag('NS', 0, 0),
            'DESCR' => new ParseTag('DESCR', 1, 1),
            'CONT' => new ParseTag('CONT', 1, 0, 1),
            'SEE_ALSO' => new ParseTag('SEE_ALSO', 0, 1),
            'STATIC' => new ParseTag('STATIC', 0, 0)
            );

        $this->_def['PAGENAV'] = array(
            'ID' => new ParseTag('ID', 0, 0),
            'NS' => new ParseTag('NS', 0, 0),
            'TOP_NAV' => new ParseTag('TOP_NAV', 0, 0),
            'CONT' => new ParseTag('CONT', 1, 0, 1),
            'NAV_SEQ' => new ParseTag('NAV_SEQ', 1, 0, 1)
            );

        $this->_def['HELPDOC'] = array(
            'ITEM' => 'DocItem',
            'TBL' => 'DocTable',
            'PAGE' => 'DocPage',
            'PAGENAV' => 'NavChain'
        );
    }
}
