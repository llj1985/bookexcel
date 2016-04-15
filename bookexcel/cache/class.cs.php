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

<?php  if ($package != ''):  ?>
namespace <?php echo $package; ?> 
{
<?php  endif;  ?>
    public partial class <?php echo $className; ?>Mgr : 
<?php  if ($TKey1 && $TKey2):  ?>
        <?php echo $managerParentClass; ?><<?php echo $TKey1; ?>, <?php echo $TKey2; ?>, <?php echo $TItem; ?>>
<?php  elseif ($TKey1):  ?>
        <?php echo $managerParentClass; ?><<?php echo $TKey1; ?>, <?php echo $TItem; ?>>
<?php  else:  ?>
        <?php echo $managerParentClass; ?><<?php echo $TItem; ?>>
<?php  endif;  ?>
    {
        public <?php echo $className; ?>Mgr()
        {
            this.setParser(new <?php echo ucfirst($fileFormat) ?>Parser());
        }

<?php  
            foreach ($fields as $field): 
            $ctype = $this->convertType2($field['type']);
            if ($field['createQuery'] && $ctype[1] == 0) :
            $name = $field['name'];
            $uname = ucfirst($name);
            $type = $ctype[0];
         ?>
        public <?php echo $className; ?> getItemBy<?php echo $uname; ?>(<?php echo $type; ?> value)
        {
            foreach (var item in itemList) 
            {
                if (item.<?php echo $name; ?> == value) {
                    return item;
                }
            }

            return null;
        }

        public IList<<?php echo $className; ?>> getItemsBy<?php echo $uname; ?>(<?php echo $type; ?> value)
        {
            var items = new List<<?php echo $className; ?>>();
            foreach (var item in itemList) 
            {
                if (item.<?php echo $name; ?> == value) {
                    items.Add(item);
                }
            }
            return items;
        }

<?php  endif;  ?>
<?php  endforeach;  ?>
    }

    public partial class <?php echo $className; ?> : ConfigItemBase
    {
<?php  foreach ($fields as $field):  ?>
        protected const string _KEY_<?php echo strtoupper($field['name']) ?> = "<?php echo $field['name']; ?>";
<?php  endforeach;  ?>

<?php  foreach ($fields as $field):  ?>
        /// <?php echo $field['desc']; ?> 
        public <?php echo $field['type']; ?> <?php echo $field['name']; ?> { get; protected set; }
<?php  endforeach;  ?>

        ///parse form <?php echo $fileFormat; ?> 
        public override bool parseFrom(IParser parser)
        {
            try{
<?php  
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
                 ?>
                this.<?php echo $name; ?> = parser.<?php echo $get; ?><<?php echo $type; ?>>(_KEY_<?php echo $uname; ?>);
<?php  if ($isPkey && $pkey == 1):  ?>
                this._key1 = this.<?php echo $name; ?>;
<?php  elseif ($isPkey && $pkey == 2):  ?>
                this._key2 = this.<?php echo $name; ?>;
<?php  endif;  ?>
<?php  endforeach;  ?>

                return true;
            } catch(Exception e)
            {
                Debug.LogWarning(e.Message);
                return false;
            }
        }
    }
<?php  if ($package != ''):  ?>
}
<?php  endif;  ?>