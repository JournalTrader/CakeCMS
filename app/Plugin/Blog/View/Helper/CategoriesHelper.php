<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriesHelper
 *
 * @author Admin
 */
class CategoriesHelper extends AppHelper
{
    public $helpers = array(
        'Form',
        'Html'
    );
    
    public function getTreeCategories($data, $select)
    {
        return $this->recursive($data, 0, $select);
    }
    
    public function recursive($categories, $parent, $select)
    {
        $xhtml = '';
        
        $xhtml .= '<ul>';
        
        foreach($categories as $category)
        {
            if($category['Term']['parent_id'] == $parent)
            {
                
                $xhtml .= $this->typeSelect($category, $select);
                
                $xhtml .= $this->recursive($categories, $category['Term']['id'], $select);
            }
        }
            
        $xhtml .= '</ul>';
        
        return $xhtml;
    }
    
    public function typeSelect($category, $select)
    {
        $checked = false;
        
        if(!empty($select))
        {
            foreach($select as $d)
            {
                if($category['Term']['id'] == $d['categories_id'])
                {
                    $checked = true;
                }
            }
        }
        
        $xhtml = '';
        
        $xhtml .= '<li class="category-' . $category['Term']['id'] . '">';
        $xhtml .= '<label class="checkbox" for="cat-' . $category['Term']['id'] .'">';
        $xhtml .= $this->Form->input('ContentsCategory.categories_id.' . $category['Term']['id'], array(
            'label' => false,
            'div' => false,
            'type' => 'checkbox',
            'checked' => $checked,
            'value' => $category['Term']['id']
        ));
        $xhtml .= $category['Term']['title'] . '</label>';
        $xhtml .= '</li>';
        
        return $xhtml;
    }
    
    public function getListCategories($categories)
    {
        $xhtml = '';
        
        if(!empty($categories))
        {
            $xhtml .= '<ul class="list-categories">';
            foreach($categories as $categorie)
            {
                $xhtml .= '<li><a href="' . $this->Html->url(array(
                    'plugin' => 'blog',
                    'controller' => 'blog',
                    'action' => 'category',
                    'slug' => $categorie['slug']
                )) . '"><i class="icon-folder-open"></i> ' . $categorie['title'] . '</a></li>';
            }
            $xhtml .= '</ul>';
        }
        return $xhtml;
    }
}

?>
