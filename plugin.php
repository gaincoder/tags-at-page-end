<?php

class pluginTagsEndPage extends Plugin {

    public function init()
    {
        $this->dbFields = array(
            'title' => 'Tags',
            'tag' => 'h2',
            'separator' => ' , '
        );
    }

    public function form()
    {
        global $L;

        $html  = '<div class="alert alert-primary" role="alert">';
        $html .= $this->description();
        $html .= '</div>';

        $html .= '<div>';
        $html .= '<label>'.$L->get('Title').'</label>';
        $html .= '<input name="title" type="text" value="'.$this->getValue('title').'">';
        $html .= '<label>'.$L->get('Title').' HTML Tag</label>';
        $html .= '<input name="tag" type="text" value="'.$this->getValue('tag').'">';
        $html .= '<label>'.$L->get('Tag Separator').'</label>';
        $html .= '<input name="separator" type="text" value="'.$this->getValue('separator').'">';
        $html .= '</div>';

        return $html;
    }

    public function pageEnd()
    {
        global $page;
        global $url;

        $html = '<div class="tags-at-page-end">';
        if(count($page->getValue('tags')) &&  $url->whereAmI() == 'page' ) {
            $html .= '<' . $this->getValue('tag') . '>' . $this->getValue('title') . '</' . $this->getValue('tag') . '>';
            $tagsLinks = array();
            foreach ($page->getValue('tags') as $key => $tag) {
                $tagsLinks[] = '<a href="'.DOMAIN_TAGS.$key.'">'.$tag.'</a>';
            }
            $html .= implode($this->getValue('separator'),$tagsLinks);
        }
        return $html;
    }


}