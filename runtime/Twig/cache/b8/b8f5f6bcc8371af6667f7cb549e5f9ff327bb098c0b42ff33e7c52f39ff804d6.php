<?php

/* public-notice.html */
class __TwigTemplate_88ca31022321d3fa3b9c8f1d0a375209aa151e4d3c5d52473d15331470a6ad50 extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "public-notice.html", 1);
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
        echo "<table id=\"listdata\"  class=\"easyui-datagrid\" title=\"虚拟物品列表\" data-options=\"toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/public-notice"), "html", null, true);
        echo "',pageSize:50\">
    <thead>
    <tr style=\"height:200px;\">
        <th data-options=\"field:'from', width:150, align:'center'\" formatter=\"formatFrom\">来源</th>
        <th data-options=\"field:'icon', width:100, align:'center'\">图标</th>
        <th data-options=\"field:'title', width:100, align:'center'\">标题</th>
        <th data-options=\"field:'desc', width:300, align:'center'\">描述</th>
        <th data-options=\"field:'type', width:100, align:'center'\" >公告类别</th>
        <th data-options=\"field:'status',width:100, align:'center'\" formatter=\"formatStatus\">是否启用</th>
    </tr>
    </thead>
</table>

<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" onclick=\"javascript:\$('#dlg-add').dialog('open');\">新增</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" onclick=\"edit()\">编辑</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-cancel',plain:true\" onclick=\"del()\">删除</a>
    </div>
</div>

<div id=\"dlg-add\" title=\"新增\" class=\"easyui-dialog\" style=\"width:750px;height:auto;padding:10px 20px;\" modal=\"true\" closed=\"true\" buttons=\"#dlg-buttons-add\">
    <form id=\"public_notice\" method=\"post\">
        <table cellpadding=\"5\">
            <tr>
                <td>站点</td>
                <td>
                    <select name=\"from\">
                        <option value=\"1\" >伙购网</option>
                        <option value=\"2\" >滴滴夺宝</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>公告类别:</td>
                <td>
                    <select name=\"type\">
                        <option value=\"public_notice\" selected>默认</option>
                        <option value=\"activity_notice\">活动消息</option>
                    </select>
                    <input type=\"text\" name=\"content[notice_link]\" style=\"display: none;width: 300px;\">
                </td>
            </tr>
            <tr>
                <td>标题:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[notice_title]\" data-options=\"required:true,width:200\"></td>
            </tr>
            <tr>
                <td>简介:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[notice_desc]\" data-options=\"required:true,width:400\"></td>
            </tr>
            <tr>
                <td>图标:</td>
                <td><input class=\"easyui-textbox\" type=\"text\" name=\"content[notice_icon]\" data-options=\"required:true,width:200\"></td>
            </tr>
            <tr>
                <td>类型:</td>
                <td>
                    <select class=\"easyui-combobox\" name=\"content[notice_type]\" id=\"noticeType\" data-options=\"required:true\">
                        <option value=\"default\" selected>默认</option>
                        <option value=\"link\">打开链接</option>
                    </select>
                    <input type=\"text\" name=\"content[notice_link]\" style=\"display: none;width: 300px;\">
                </td>
            </tr>
            <tr id=\"notice_content\">
                <td>内容:</td>
                <td>
                    <textarea name=\"content[notice_content]\" style=\"width: 400px;height: 300px;\" ></textarea>
                </td>
            </tr>
            <tr>
                <td>时间:</td>
                <td><input class=\"easyui-datetimebox\" type=\"text\" name=\"content[notice_time]\" data-options=\"required:true\" /></td>
            </tr>
            <tr>
                <td>是否显示:</td>
                <td><input type=\"checkbox\" name=\"status\" value=\"1\" checked></td>
            </tr>
        </table>
    </form>
    <div style=\"text-align:center;padding:5px\">
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" onclick=\"submitForm()\">提交</a>
    </div>
</div>

<div id=\"dlg-edit\" class=\"easyui-window\" title=\"修改\" style=\"padding:10px;overflow:hidden;\" data-options=\"width:800,height:600,iconCls:'icon-save',closed:true,modal:true,onResize:function(){ \$(this).window('hcenter');}\">
    <iframe width=\"100%\" height=\"100%\" frameborder=\"0\" id=\"edit_iframe\">
    </iframe>
</div>
";
    }

    // line 96
    public function block_js($context, array $blocks = array())
    {
        // line 97
        echo "<script>

    var noticeTypeSel = \$('#noticeType').combobox({
        onSelect:function(record){
            if (record.value=='default') {
                \$('input[name=\"content[notice_link]\"]').hide();
                \$('#notice_content').show()
            } else if (record.value=='link') {
                \$('input[name=\"content[notice_link]\"]').show();
                \$('#notice_content').hide()
            }
        }
    });

    function edit()
    {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择');
            return false;
        }
        \$('#edit_iframe').prop('src', \"";
        // line 118
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/edit"), "html", null, true);
        echo "\" + '?type=public_notice&id=' + selRow.id);
        \$('#dlg-edit').window('open');
    }

    function del()
    {
        var selRow = \$('#listdata').datagrid('getSelected');
        if (!selRow) {
            \$.messager.alert('错误','请选择');
            return false;
        }
        \$.messager.confirm('Confirm', '确认删除吗?', function(r) {
            \$.get(\"";
        // line 130
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("app/del"), "html", null, true);
        echo "\", {'id':selRow.id}, function(data) {
                if (data.error) {
                    \$.messager.alert('错误', data.message, 'error');
                } else {
                    \$.messager.alert('成功', data.message);
                    window.location.reload();
                }
            }, 'json');
        });
    }

    function add()
    {
        \$('#dlg-add').dialog('open');
    }

    function submitForm()
    {
        \$('#public_notice').form({
            url: '/app/add-public-notice',
            onSubmit: function(param){
                var isValid = \$(this).form('validate');
                if (!isValid){
                    \$.messager.progress('close');\t// 如果表单是无效的则隐藏进度条
                }
                return isValid;\t// 返回false终止表单提交
            },
            success: function (data) {
                data = eval('(' + data + ')');
                if (data.error == 0) {
                    \$.messager.alert('成功', data.message);
                    setTimeout(function(){parent.location.reload()}, 2000);
                } else {
                    \$.messager.alert('失败', data.message);
                    return false;
                }
            }
        });
        \$('#public_notice').submit();
    }

    function formatStatus(val, row)
    {
        if(val == 1) return '启用';
        else return '不启用';
    }

    function formatType(val, row)
    {
        if(val == 'default') {
            return '默认';
        } else if (val=='link') {
            return '打开链接';
        }
        return '未知';
    }

    function formatFrom(val, row) {
        if (val==1) {
            return '伙购网';
        } else if (val==2) {
            return '滴滴夺宝';
        }
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "public-notice.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 130,  154 => 118,  131 => 97,  128 => 96,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table id="listdata"  class="easyui-datagrid" title="虚拟物品列表" data-options="toolbar:'#tb-user',singleSelect:true,pagination:true,method:'get',url:'{{ url('app/public-notice') }}',pageSize:50">*/
/*     <thead>*/
/*     <tr style="height:200px;">*/
/*         <th data-options="field:'from', width:150, align:'center'" formatter="formatFrom">来源</th>*/
/*         <th data-options="field:'icon', width:100, align:'center'">图标</th>*/
/*         <th data-options="field:'title', width:100, align:'center'">标题</th>*/
/*         <th data-options="field:'desc', width:300, align:'center'">描述</th>*/
/*         <th data-options="field:'type', width:100, align:'center'" >公告类别</th>*/
/*         <th data-options="field:'status',width:100, align:'center'" formatter="formatStatus">是否启用</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="javascript:$('#dlg-add').dialog('open');">新增</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" onclick="edit()">编辑</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-cancel',plain:true" onclick="del()">删除</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-add" title="新增" class="easyui-dialog" style="width:750px;height:auto;padding:10px 20px;" modal="true" closed="true" buttons="#dlg-buttons-add">*/
/*     <form id="public_notice" method="post">*/
/*         <table cellpadding="5">*/
/*             <tr>*/
/*                 <td>站点</td>*/
/*                 <td>*/
/*                     <select name="from">*/
/*                         <option value="1" >伙购网</option>*/
/*                         <option value="2" >滴滴夺宝</option>*/
/*                     </select>*/
/*                 </td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>公告类别:</td>*/
/*                 <td>*/
/*                     <select name="type">*/
/*                         <option value="public_notice" selected>默认</option>*/
/*                         <option value="activity_notice">活动消息</option>*/
/*                     </select>*/
/*                     <input type="text" name="content[notice_link]" style="display: none;width: 300px;">*/
/*                 </td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>标题:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="content[notice_title]" data-options="required:true,width:200"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>简介:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="content[notice_desc]" data-options="required:true,width:400"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>图标:</td>*/
/*                 <td><input class="easyui-textbox" type="text" name="content[notice_icon]" data-options="required:true,width:200"></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>类型:</td>*/
/*                 <td>*/
/*                     <select class="easyui-combobox" name="content[notice_type]" id="noticeType" data-options="required:true">*/
/*                         <option value="default" selected>默认</option>*/
/*                         <option value="link">打开链接</option>*/
/*                     </select>*/
/*                     <input type="text" name="content[notice_link]" style="display: none;width: 300px;">*/
/*                 </td>*/
/*             </tr>*/
/*             <tr id="notice_content">*/
/*                 <td>内容:</td>*/
/*                 <td>*/
/*                     <textarea name="content[notice_content]" style="width: 400px;height: 300px;" ></textarea>*/
/*                 </td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>时间:</td>*/
/*                 <td><input class="easyui-datetimebox" type="text" name="content[notice_time]" data-options="required:true" /></td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <td>是否显示:</td>*/
/*                 <td><input type="checkbox" name="status" value="1" checked></td>*/
/*             </tr>*/
/*         </table>*/
/*     </form>*/
/*     <div style="text-align:center;padding:5px">*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">提交</a>*/
/*     </div>*/
/* </div>*/
/* */
/* <div id="dlg-edit" class="easyui-window" title="修改" style="padding:10px;overflow:hidden;" data-options="width:800,height:600,iconCls:'icon-save',closed:true,modal:true,onResize:function(){ $(this).window('hcenter');}">*/
/*     <iframe width="100%" height="100%" frameborder="0" id="edit_iframe">*/
/*     </iframe>*/
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block js %}*/
/* <script>*/
/* */
/*     var noticeTypeSel = $('#noticeType').combobox({*/
/*         onSelect:function(record){*/
/*             if (record.value=='default') {*/
/*                 $('input[name="content[notice_link]"]').hide();*/
/*                 $('#notice_content').show()*/
/*             } else if (record.value=='link') {*/
/*                 $('input[name="content[notice_link]"]').show();*/
/*                 $('#notice_content').hide()*/
/*             }*/
/*         }*/
/*     });*/
/* */
/*     function edit()*/
/*     {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择');*/
/*             return false;*/
/*         }*/
/*         $('#edit_iframe').prop('src', "{{ url('app/edit') }}" + '?type=public_notice&id=' + selRow.id);*/
/*         $('#dlg-edit').window('open');*/
/*     }*/
/* */
/*     function del()*/
/*     {*/
/*         var selRow = $('#listdata').datagrid('getSelected');*/
/*         if (!selRow) {*/
/*             $.messager.alert('错误','请选择');*/
/*             return false;*/
/*         }*/
/*         $.messager.confirm('Confirm', '确认删除吗?', function(r) {*/
/*             $.get("{{ url('app/del') }}", {'id':selRow.id}, function(data) {*/
/*                 if (data.error) {*/
/*                     $.messager.alert('错误', data.message, 'error');*/
/*                 } else {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     window.location.reload();*/
/*                 }*/
/*             }, 'json');*/
/*         });*/
/*     }*/
/* */
/*     function add()*/
/*     {*/
/*         $('#dlg-add').dialog('open');*/
/*     }*/
/* */
/*     function submitForm()*/
/*     {*/
/*         $('#public_notice').form({*/
/*             url: '/app/add-public-notice',*/
/*             onSubmit: function(param){*/
/*                 var isValid = $(this).form('validate');*/
/*                 if (!isValid){*/
/*                     $.messager.progress('close');	// 如果表单是无效的则隐藏进度条*/
/*                 }*/
/*                 return isValid;	// 返回false终止表单提交*/
/*             },*/
/*             success: function (data) {*/
/*                 data = eval('(' + data + ')');*/
/*                 if (data.error == 0) {*/
/*                     $.messager.alert('成功', data.message);*/
/*                     setTimeout(function(){parent.location.reload()}, 2000);*/
/*                 } else {*/
/*                     $.messager.alert('失败', data.message);*/
/*                     return false;*/
/*                 }*/
/*             }*/
/*         });*/
/*         $('#public_notice').submit();*/
/*     }*/
/* */
/*     function formatStatus(val, row)*/
/*     {*/
/*         if(val == 1) return '启用';*/
/*         else return '不启用';*/
/*     }*/
/* */
/*     function formatType(val, row)*/
/*     {*/
/*         if(val == 'default') {*/
/*             return '默认';*/
/*         } else if (val=='link') {*/
/*             return '打开链接';*/
/*         }*/
/*         return '未知';*/
/*     }*/
/* */
/*     function formatFrom(val, row) {*/
/*         if (val==1) {*/
/*             return '伙购网';*/
/*         } else if (val==2) {*/
/*             return '滴滴夺宝';*/
/*         }*/
/*     }*/
/* </script>*/
/* {% endblock %}*/
