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

    public partial class SheetCfgMgr : 
        bookrpg.config.ConfigMgrSingleKey<uint, SheetCfg>
    {
        public SheetCfgMgr()
        {
            this.setParser(new TxtParser());
        }

    }

    public partial class SheetCfg : ConfigItemBase
    {
        protected const string _KEY_ID = "id";
        protected const string _KEY_NAME = "name";
        protected const string _KEY_COLOR = "color";
        protected const string _KEY_MOVETYPE = "moveType";
        protected const string _KEY_CAMPOS = "camPos";
        protected const string _KEY_REWARDS = "rewards";
        protected const string _KEY_HEADICON = "headIcon";

        /// 类型ID(唯一标识符) 
        public uint id { get; protected set; }
        /// string[] 
        public string[] name { get; protected set; }
        /// int[][] 
        public int[][] color { get; protected set; }
        /// 移动类型 
        public bool moveType { get; protected set; }
        /// 观察起点 
        public float[] camPos { get; protected set; }
        /// 奖励 
        public int[][] rewards { get; protected set; }
        /// 头像Icon 
        public string headIcon { get; protected set; }

        ///parse form txt 
        public override bool parseFrom(IParser parser)
        {
            try{
                this.id = parser.getValue<uint>(_KEY_ID);
                this._key1 = this.id;
                this.name = parser.getList<string>(_KEY_NAME);
                this.color = parser.getListGroup<int>(_KEY_COLOR);
                this.moveType = parser.getValue<bool>(_KEY_MOVETYPE);
                this.camPos = parser.getList<float>(_KEY_CAMPOS);
                this.rewards = parser.getListGroup<int>(_KEY_REWARDS);
                this.headIcon = parser.getValue<string>(_KEY_HEADICON);

                return true;
            } catch(Exception e)
            {
                Debug.LogWarning(e.Message);
                return false;
            }
        }
    }