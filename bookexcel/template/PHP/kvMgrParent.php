﻿{%echo '<?php'%} 
/**
 * Generated by bookexcel
 * Do't modify this file directly, modify child class file instead
 */

{% if ($package != ''): %}
namespace {%:$this->convertPackage($package)%};
{% endif; %}

require_once __DIR__ . '/{%$className%}.php';

{%$filename = $managerClassName.$parentSuffix;%}
class {%:$managerClassName.$parentSuffix%} extends \{%$managerParentClass%} 
{
    public function __construct()
    {
        $parser = new \{%:ucfirst($fileFormat)%}Parser();
        $parser->setArrayDelemiter('{%$arrayDelimiter%}', '{%$innerArrayDelimiter%}');
        $this->setParser($parser);
        $this->setItemClass('{%$className%}');
        $this->resourceName = '{%$exportFile%}';
    }

    {% 
        $nameIndex = array_search('itemName', $nameRow);
        $typeIndex = array_search('itemType', $nameRow);
        foreach ($dataRow as $row): 
        $type = $this->convertType($row[$typeIndex]);
        $name = $row[$nameIndex];
    %}
    protected ${%$name%};
    
    public function get{%:ucfirst($name)%}()
    {
        return $this->{%$name%};
    }

    {% endforeach; %}

    public function init($text, $format='')
    {
        if (parent::init($text, $format)) {
            {% 
                foreach ($dataRow as $row): 
                $name = $row[$nameIndex];
                $type = $this->convertType($row[$typeIndex]);
            %}
            $this->{%$name%} = $this->getItem("{%$name%}")->value;
            {% endforeach; %}
            return true;
        }
        return false;
    }
}