<?php

/* index.html */
class __TwigTemplate_5cafa7cd3058507a1e73b0edb57cbea60a1a88d1fb7b853477d5bf7f004dc458 extends yii\twig\Template
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
        echo "<table title=\"充值活动\" id=\"listdata\"  class=\"easyui-datagrid\" data-options=\"toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'";
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("/rechargereward/index"), "html", null, true);
        echo "',rownumbers: false\">
    <thead>
        <tr>
            <th data-options=\"field:'id',align:'center'\" width=\"50\">ID</th>
            <th data-options=\"field:'name',align:'center'\" width=\"200\">活动名称</th>
            <th data-options=\"field:'start_time',align:'center'\" width=\"200\">活动开始时间</th>
            <th data-options=\"field:'end_time',align:'center'\" width=\"200\">活动结束时间</th>
            <th data-options=\"field:'prizes',align:'center'\" width=\"300\">奖品内容</th>
            <th data-options=\"field:'status',align:'center'\" width=\"50\">状态</th>
        </tr>
    </thead>
</table>
<div id=\"tb-user\" style=\"height:auto\">
    <div>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-add',plain:true\" id=\"new\">添加充值活动</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-edit',plain:true\" id=\"edit\">编辑</a>
        <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" data-options=\"iconCls:'icon-view',plain:true\" onclick=\"view()\">明细</a>
    </div>
</div>
<div class=\"easyui-window\" data-options=\"closed:true,\" id=\"dlg-view\" title=\"新增充值活动\" style=\"width:750px;height: auto\" modal=\"true\">
    <iframe id=\"rechargereward-edit\" frameborder=\"0\" style=\"width:786px;height: 620px;\" scrolling=\"no\"></iframe>
</div>
";
    }

    // line 27
    public function block_js($context, array $blocks = array())
    {
        // line 28
        echo "<script type=\"text/javascript\">
    \$(function(){
        \$(\"#new\").click(function(){
            \$('#rechargereward-edit').prop('src',  '/rechargereward/edit');
            \$('#dlg-view').window('open');
        })
        \$(\"#edit\").click(function(){
            var selRow = \$('#listdata').treegrid('getSelected');
            if (!selRow) {
                \$.messager.alert('错误','请选择活动');
                return false;
            }
            \$('#rechargereward-edit').prop('src',  '/rechargereward/edit?id='+selRow.id);
            \$('#dlg-view').window('open');
        })
    })
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
        return array (  63 => 28,  60 => 27,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <table title="充值活动" id="listdata"  class="easyui-datagrid" data-options="toolbar:'#tb-user',rownumbers:true,singleSelect:true,pagination:true,method:'get',url:'{{ url('/rechargereward/index') }}',rownumbers: false">*/
/*     <thead>*/
/*         <tr>*/
/*             <th data-options="field:'id',align:'center'" width="50">ID</th>*/
/*             <th data-options="field:'name',align:'center'" width="200">活动名称</th>*/
/*             <th data-options="field:'start_time',align:'center'" width="200">活动开始时间</th>*/
/*             <th data-options="field:'end_time',align:'center'" width="200">活动结束时间</th>*/
/*             <th data-options="field:'prizes',align:'center'" width="300">奖品内容</th>*/
/*             <th data-options="field:'status',align:'center'" width="50">状态</th>*/
/*         </tr>*/
/*     </thead>*/
/* </table>*/
/* <div id="tb-user" style="height:auto">*/
/*     <div>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" id="new">添加充值活动</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true" id="edit">编辑</a>*/
/*         <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-view',plain:true" onclick="view()">明细</a>*/
/*     </div>*/
/* </div>*/
/* <div class="easyui-window" data-options="closed:true," id="dlg-view" title="新增充值活动" style="width:750px;height: auto" modal="true">*/
/*     <iframe id="rechargereward-edit" frameborder="0" style="width:786px;height: 620px;" scrolling="no"></iframe>*/
/* </div>*/
/* {% endblock %}*/
/* {% block js %}*/
/* <script type="text/javascript">*/
/*     $(function(){*/
/*         $("#new").click(function(){*/
/*             $('#rechargereward-edit').prop('src',  '/rechargereward/edit');*/
/*             $('#dlg-view').window('open');*/
/*         })*/
/*         $("#edit").click(function(){*/
/*             var selRow = $('#listdata').treegrid('getSelected');*/
/*             if (!selRow) {*/
/*                 $.messager.alert('错误','请选择活动');*/
/*                 return false;*/
/*             }*/
/*             $('#rechargereward-edit').prop('src',  '/rechargereward/edit?id='+selRow.id);*/
/*             $('#dlg-view').window('open');*/
/*         })*/
/*     })*/
/* </script>*/
/* {% endblock %}*/