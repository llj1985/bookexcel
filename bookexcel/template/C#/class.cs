﻿///
/// Generated by bookexcel
/// Do't modify this file directly, new partial class file instead
///

using System;
using System.Collections;
using System.Collections.Generic;
using LitJson;
using bookrpg.config;
using UnityEngine;

{% if ($package != ''): %}
namespace {%$package%} 
{
{% endif; %}
    public partial class {%$className%}Mgr : 
        {% if ($TKey1 && $TKey2): %}
        {%$managerParentClass%}<{%$TKey1%}, {%$TKey2%}, {%$TItem%}>
        {% elseif ($TKey1): %}
        {%$managerParentClass%}<{%$TKey1%}, {%$TItem%}>
        {% else: %}
        {%$managerParentClass%}<{%$TItem%}>
        {% endif; %}
    {
        public {%$className%}Mgr()
        {
            this.setParser(new {%:ucfirst($fileFormat)%}Parser());
        }

        {% 
            foreach ($fields as $field): 
            $ctype = $this->convertType2($field['type']);
            if ($field['createQuery'] && $ctype[1] == 0) :
            $name = $field['name'];
            $uname = ucfirst($name);
            $type = $ctype[0];
        %}
        public {%$className%} getItemBy{%$uname%}({%$type%} value)
        {
            foreach (var item in itemList) 
            {
                if (item.{%$name%} == value) {
                    return item;
                }
            }

            return null;
        }

        public IList<{%$className%}> getItemsBy{%$uname%}({%$type%} value)
        {
            var items = new List<{%$className%}>();
            foreach (var item in itemList) 
            {
                if (item.{%$name%} == value) {
                    items.Add(item);
                }
            }
            return items;
        }

        {% endif; %}
        {% endforeach; %}
    }

    public partial class {%$className%} : ConfigItemBase
    {
        {% foreach ($fields as $field): %}
        protected const string _KEY_{%:strtoupper($field['name'])%} = "{%$field['name']%}";
        {% endforeach; %}

        {% foreach ($fields as $field): %}
        /// {%$field['desc']%} 
        public {%$field['type']%} {%$field['name']%} { get; protected set; }
        {% endforeach; %}

        ///parse form {%$fileFormat%} 
        public override bool parseFrom(IParser parser)
        {
            try{
                {% 
                    $pkey = 0;
                    foreach ($fields as $field): 
                    $name = $field['name'];
                    $uname = strtoupper($name);
                    $ctype = $this->convertType2($field['type']);
                    $type = $ctype[0];
                    $arrDeep = $ctype[1];
                    $get = 'getValue';
                    if ($arrDeep == 1) {
                        $get = 'getList';
                    } elseif($arrDeep > 1) {
                        $get = 'getListGroup';
                    }
                    $isPkey = $field['isPrimaryKey'];
                    $pkey += $isPkey ? 1 : 0;
                %}
                this.{%$name%} = parser.{%$get%}<{%$type%}>(_KEY_{%$uname%});
                {% if ($isPkey && $pkey == 1): %}
                this._key1 = this.{%$name%};
                {% elseif ($isPkey && $pkey == 2): %}
                this._key2 = this.{%$name%};
                {% endif; %}
                {% endforeach; %}

                return true;
            } catch(Exception e)
            {
                Debug.LogWarning(e.Message);
                return false;
            }
        }
    }
{% if ($package != ''): %}
}
{% endif; %}