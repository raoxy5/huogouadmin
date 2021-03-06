<?php

/* index.html */
class __TwigTemplate_a4d222d166d64fa68e7442451113e9a71fdb75e339c28e41596bf0c4f1bd2e5a extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "index.html", 1);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
            'js' => array($this, 'block_js'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@app/views/base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_main($context, array $blocks = array())
    {
        // line 4
        echo "
<div class=\"search\">
    <span>用户名 <input class=\"easyui-textbox\" type=\"text\" name=\"account\" id=\"account\"></span>
    <span>类型
        <select class=\"easyui-combobox\" id=\"status\" name=\"status\" data-options=\"required:true, panelHeight:'auto'\">
            <option value=\"all\">所有</option>
            <option value=\"1\">晒单评论</option>
        </select>
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
</div>

<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"黑名单列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("blacklist"), "html", null, true);
        echo "',pageSize:20\">
    <thead>
        <tr>
            <th data-options=\"field:'type', width:200, align:'center'\" formatter=\"formatType\">类型</th>
            <th data-options=\"field:'user_id', width:100, align:'center'\">用户ID</th>
            <th data-options=\"field:'username', width:200, align:'center'\" formatter=\"formatName\">用户名</th>
            <th data-options=\"field:'created_at', width:200, align:'center'\" formatter=\"formatTime\">添加时间</th>
        </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"add()\">新增</a>
        <!--<a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>-->
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-redo',plain:true\" onclick=\"del()\">删除</a>
    </div>
</div>

<!--新增员工-->
<div id=\"dlg-add\" title=\"新增黑名单\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    ";
        // line 37
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "addForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>类型</td>
            <td>
                <select class=\"easyui-combobox\" id=\"type\" name=\"BlackList[type]\" data-options=\"required:true, panelHeight:'auto'\">
                    <option value=\"1\">晒单评论</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>账号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"BlackList[account]\" data-options=\"required:true\"></td>
        </tr>
    </table>
    ";
        // line 52
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-add\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('add')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-add').dialog('close')\">取消</a>
</div>
<!--新增员工-->

<!--编辑员工-->
<div id=\"dlg-edit\" title=\"编辑黑名单\" class=\"easyui-dialog\" style=\"width:350px;height:auto;padding:10px 20px\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-edit\">
    ";
        // line 63
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "beginForm", array(0 => "", 1 => "post", 2 => array("class" => "am-form am-form-horizontal", "id" => "editForm")), "method");
        echo "
    <table cellpadding=\"5\">
        <tr>
            <td>类型</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Admin[job_number]\" data-options=\"required:true\"></td>
        </tr>
        <tr>
            <td>账号</td>
            <td><input class=\"easyui-textbox\" type=\"text\" name=\"Admin[username]\" data-options=\"required:true\"></td>
        </tr>
    </table>
    ";
        // line 74
        echo $this->getAttribute((isset($context["html"]) ? $context["html"] : null), "endForm", array(), "method");
        echo "
</div>

<div id=\"dlg-buttons-edit\" style=\"text-align:center;padding:5px\">
    <a class=\"easyui-linkbutton\" iconCls=\"icon-ok\" onclick=\"save('edit')\">确定</a>
    <a class=\"easyui-linkbutton\" iconCls=\"icon-cancel\" onclick=\"javascript:\$('#dlg-edit').dialog('close')\">取消</a>
</div>
<!--编辑员工-->

";
    }

    // line 85
    public function block_js($context, array $blocks = array())
    {
        // line 86
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.account = \$('#account').val();
        queryParams.type\t= \$('#type').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }

    function formatType(val, row) {
        if (val == 0) {
            return '全站';
        } else if (val == 1) {
            return '晒单评论';
        }
    }

    function add() {
        \$('#addForm').form('clear');
        \$('#dlg-add').window('open');
    }

    function edit() {
        var selRow = \$('#listdata').datagrid('getSelected');
        console.log(selRow);
        if (!selRow) {
            \$.messager.alert('错误','请选择账号');
            return false;
        }

        \$('#editForm').form('clear');
        \$('#role_edit').combobox({
            url:\"";
        // line 118
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("role/list"), "html", null, true);
        echo "\",
            method:'get',
            valueField: 'id',
            textField: 'text'
        });
        \$('#edit_privilege').combotree({
            url: \"";
        // line 124
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("auth/menu-list"), "html", null, true);
        echo "\",
            method: 'get',
            cascadeCheck: false,
            onCheck: function (node, checked) {
                myCascadeCheck(\$('#edit_privilege'), node, checked);
            }
        });
        \$('#dlg-edit').form('load',{
            'Admin[job_number]' : selRow.job_number,
            'Admin[real_name]' : selRow.real_name,
            'Admin[username]' : selRow.username,
            'Admin[password]' : selRow.password,
            'Admin[phone]' : selRow.phone,
            'Admin[email]' : selRow.email,
            'Admin[role]' : selRow.role,
            'Admin[status]' : selRow.status
        });
        \$('#edit_privilege').combotree('setValues', selRow.privilege.split(\",\"));

        \$('#dlg-edit').window('open');
    }

    function del() {
        var selRow = \$('#listdata').treegrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择一行');
            return false;
        }

        \$.messager.confirm('Confirm', '您确定删除该黑名单？', function(r) {
            if (r) {
                \$.post(\"";
        // line 155
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("blacklist/del"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                    if (data.error) {
                        \$.messager.alert('错误', data.message, 'error');
                    } else {
                        \$.messager.alert('成功', data.message);
                        reloadgrid();
                    }
                }, 'json');
            }
        });
    }

    // 确认保存
    function save(flag){
        if (flag == 'edit') {
            var selRow = \$('#listdata').datagrid('getSelected');
            var url = '/blacklist/edit?id=' + selRow.id;
            var form = 'editForm';
        } else if (flag == 'add') {
            var url = '/blacklist/add';
            var form = 'addForm';
        }


        \$('#' + form).form({
            url: url,
            onSubmit:function(){
                return \$(this).form('enableValidation').form('validate');
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    window.location.href = '/blacklist';
                } else {
                    \$.messager.alert('失败', data.message, 'error');
                }
            }
        });
        \$('#' + form).submit();
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  210 => 155,  176 => 124,  167 => 118,  133 => 86,  130 => 85,  116 => 74,  102 => 63,  88 => 52,  70 => 37,  46 => 16,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* */
/* <div class="search">*/
/*     <span>用户名 <input class="easyui-textbox" type="text" name="account" id="account"></span>*/
/*     <span>类型*/
/*         <select class="easyui-combobox" id="status" name="status" data-options="required:true, panelHeight:'auto'">*/
/*             <option value="all">所有</option>*/
/*             <option value="1">晒单评论</option>*/
/*         </select>*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/* </div>*/
/* */
/* <table id="listdata"  class="easyui-datagrid" title="黑名单列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{  url('blacklist')}}',pageSize:20">*/
/*     <thead>*/
/*         <tr>*/
/*             <th data-options="field:'type', width:200, align:'center'" formatter="formatType">类型</th>*/
/*             <th data-options="field:'user_id', width:100, align:'center'">用户ID</th>*/
/*             <th data-options="field:'username', width:200, align:'center'" formatter="formatName">用户名</th>*/
/*             <th data-options="field:'created_at', width:200, align:'center'" formatter="formatTime">添加时间</th>*/
/*         </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="add()">新增</a>*/
/*         <!--<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>-->*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="del()">删除</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <!--新增员工-->*/
/* <div id="dlg-add" title="新增黑名单" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'addForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>类型</td>*/
/*             <td>*/
/*                 <select class="easyui-combobox" id="type" name="BlackList[type]" data-options="required:true, panelHeight:'auto'">*/
/*                     <option value="1">晒单评论</option>*/
/*                 </select>*/
/*             </td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>账号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="BlackList[account]" data-options="required:true"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-add" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('add')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-add').dialog('close')">取消</a>*/
/* </div>*/
/* <!--新增员工-->*/
/* */
/* <!--编辑员工-->*/
/* <div id="dlg-edit" title="编辑黑名单" class="easyui-dialog" style="width:350px;height:auto;padding:10px 20px" modal="true" closed="true" buttons="#dlg-buttons-edit">*/
/*     {{ html.beginForm('', 'post', {'class':'am-form am-form-horizontal', 'id':'editForm'}) | raw }}*/
/*     <table cellpadding="5">*/
/*         <tr>*/
/*             <td>类型</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Admin[job_number]" data-options="required:true"></td>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>账号</td>*/
/*             <td><input class="easyui-textbox" type="text" name="Admin[username]" data-options="required:true"></td>*/
/*         </tr>*/
/*     </table>*/
/*     {{ html.endForm() | raw }}*/
/* </div>*/
/* */
/* <div id="dlg-buttons-edit" style="text-align:center;padding:5px">*/
/*     <a class="easyui-linkbutton" iconCls="icon-ok" onclick="save('edit')">确定</a>*/
/*     <a class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close')">取消</a>*/
/* </div>*/
/* <!--编辑员工-->*/
/* */
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.account = $('#account').val();*/
/*         queryParams.type	= $('#type').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/* */
/*     function formatType(val, row) {*/
/*         if (val == 0) {*/
/*             return '全站';*/
/*         } else if (val == 1) {*/
/*             return '晒单评论';*/
/*         }*/
/*     }*/
/* */
/*     function add() {*/
/*         $('#addForm').form('clear');*/
/*         $('#dlg-add').window('open');*/
/*     }*/
/* */
/*     function edit() {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         console.log(selRow);*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择账号');*/
/*             return false;*/
/*         }*/
/* */
/*         $('#editForm').form('clear');*/
/*         $('#role_edit').combobox({*/
/*             url:"{{ url('role/list') }}",*/
/*             method:'get',*/
/*             valueField: 'id',*/
/*             textField: 'text'*/
/*         });*/
/*         $('#edit_privilege').combotree({*/
/*             url: "{{ url('auth/menu-list') }}",*/
/*             method: 'get',*/
/*             cascadeCheck: false,*/
/*             onCheck: function (node, checked) {*/
/*                 myCascadeCheck($('#edit_privilege'), node, checked);*/
/*             }*/
/*         });*/
/*         $('#dlg-edit').form('load',{*/
/*             'Admin[job_number]' : selRow.job_number,*/
/*             'Admin[real_name]' : selRow.real_name,*/
/*             'Admin[username]' : selRow.username,*/
/*             'Admin[password]' : selRow.password,*/
/*             'Admin[phone]' : selRow.phone,*/
/*             'Admin[email]' : selRow.email,*/
/*             'Admin[role]' : selRow.role,*/
/*             'Admin[status]' : selRow.status*/
/*         });*/
/*         $('#edit_privilege').combotree('setValues', selRow.privilege.split(","));*/
/* */
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function del() {*/
/*         var selRow = $('#listdata').treegrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择一行');*/
/*             return false;*/
/*         }*/
/* */
/*         $.messager.confirm('Confirm', '您确定删除该黑名单？', function(r) {*/
/*             if (r) {*/
/*                 $.post("{{ url('blacklist/del') }}", {'id':selRow.id}, function(data) {*/
/*                     if (data.error) {*/
/*                         $.messager.alert('错误', data.message, 'error');*/
/*                     } else {*/
/*                         $.messager.alert('成功', data.message);*/
/*                         reloadgrid();*/
/*                     }*/
/*                 }, 'json');*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     // 确认保存*/
/*     function save(flag){*/
/*         if (flag == 'edit') {*/
/*             var selRow = $('#listdata').datagrid('getSelected');*/
/*             var url = '/blacklist/edit?id=' + selRow.id;*/
/*             var form = 'editForm';*/
/*         } else if (flag == 'add') {*/
/*             var url = '/blacklist/add';*/
/*             var form = 'addForm';*/
/*         }*/
/* */
/* */
/*         $('#' + form).form({*/
/*             url: url,*/
/*             onSubmit:function(){*/
/*                 return $(this).form('enableValidation').form('validate');*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     window.location.href = '/blacklist';*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message, 'error');*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#' + form).submit();*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
/* */
/* */
