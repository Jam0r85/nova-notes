<?php

namespace Jam0r85\NovaNotes;

use Laravel\Nova\ResourceTool;

class NovaNotes extends ResourceTool
{
    /**
     * Construct the resource tool.
     */
    public function __construct()
    {
        parent::__construct();
        $this->withMeta(['new_note' => true]);
    }

    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Nova Notes';
    }

    /**
     * The model name are storing notes against.
     *
     * @param  string  $model
     * @return $this
     */
    public function model($model)
    {
        return $this->withMeta(['model' => $model]);
    }

    /**
     * Disable the ability to create a new note.
     *
     * @return $this
     */
    public function disableNewNotes()
    {
        return $this->withMeta(['new_note' => false]);
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-notes';
    }
}
