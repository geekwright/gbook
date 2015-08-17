<?php
/**
 * ****************************************************************************
 *  GBOOK - MODULE FOR XOOPS
 *  Copyright (c) 2007 - 2012
 *  Ingo H. de Boer (http://www.winshell.org)
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  You may not change or alter any portion of this comment or credits
 *  of supporting developers from this source code or any supporting
 *  source code which is considered copyrighted (c) material of the
 *  original comment or credit authors.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  ---------------------------------------------------------------------------
 *  @copyright       Ingo H. de Boer (http://www.winshell.org)
 *  @license         GNU General Public License (GPL)
 *  @package         GBook
 *  @author          Ingo H. de Boer (idb@winshell.org)
 *
 *  Version : 1.00 Wed 2012/06/13 22:32:57 : Ingo H. de Boer Exp $
 * ****************************************************************************
 */

/**
 * @package kernel
 * @copyright copyright &copy; 2000 XOOPS.org
 */
class gbookEntries extends XoopsObject
{
    function __construct()
    {
        $this->initVar('id', XOBJ_DTYPE_INT, null, true);
        $this->initVar('name', XOBJ_DTYPE_TXTBOX);
        $this->initVar('email', XOBJ_DTYPE_TXTBOX);
        $this->initVar('url', XOBJ_DTYPE_TXTBOX);
        $this->initVar('message', XOBJ_DTYPE_TXTAREA);
        $this->initVar('note', XOBJ_DTYPE_TXTAREA);
        $this->initVar('time', XOBJ_DTYPE_INT);
        $this->initVar('date', XOBJ_DTYPE_TXTBOX);
        $this->initVar('ip', XOBJ_DTYPE_TXTBOX);
        $this->initVar('admin', XOBJ_DTYPE_TXTBOX);
    }

    function gbookEntries()
    {
        $this->__construct();
    }

    /**
    * Get {@link XoopsThemeForm} for adding/editing categories
    *
    * @param mixed $action URL to submit to or false for $_SERVER['REQUEST_URI']
    *
    * @return object
    */
    function getForm($action = false)
    {
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $title = _GBOOK_AM_ENTRY_EDIT;

        include_once $GLOBALS['xoops']->path('class/xoopsformloader.php');

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);

        $form->addElement(new XoopsFormText(_GBOOK_AM_NAME, 'name', 35, 255, $this->getVar('name')));
        $form->addElement(new XoopsFormText(_GBOOK_AM_EMAIL, 'email', 35, 255, $this->getVar('email')));
        $form->addElement(new XoopsFormText(_GBOOK_AM_URL, 'url', 35, 255, $this->getVar('url')));
        $form->addElement(new XoopsFormTextArea(_GBOOK_AM_MESSAGE, 'message', $this->getVar('message', 'e')));
        $form->addElement(new XoopsFormTextArea(_GBOOK_AM_NOTE, 'note', $this->getVar('note', 'e')));

        $form->addElement(new XoopsFormHidden('op', 'save') );
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }
}

/**
 * @package kernel
 * @copyright copyright &copy; 2000 XOOPS.org
 */
class gbookEntriesHandler extends XoopsPersistableObjectHandler
{
    function gbookEntriesHandler(&$db)
    {
        $this->__construct($db);
    }

    function __construct(&$db)
    {
        parent::__construct($db, "gbook_entries", "gbookEntries", "id", "name", "email", "url", "message", "note", "time", "date", "ip", "admin");
    }
}
?>