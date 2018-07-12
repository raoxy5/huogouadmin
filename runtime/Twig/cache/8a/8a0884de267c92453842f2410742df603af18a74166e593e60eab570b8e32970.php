<?php

/* topic.html */
class __TwigTemplate_3200f9371c558f607b791e01fa808a97770f0714a75ce391879090106c4a060a extends yii\twig\Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@app/views/base.html", "topic.html", 1);
        $this->blocks = array(
            'main' => array($this, 'block_main'),
            'script' => array($this, 'block_script'),
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
        echo "<div class=\"search\">
    <span>时间
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"startTime\" id=\"startTime\"> 到
        <input class=\"easyui-datetimebox\" style=\"width:200px\" name=\"endTime\" id=\"endTime\">
    </span>
    <a href=\"javascript:void(0);\" onclick=\"reloadgrid();\" class=\"easyui-linkbutton\" iconCls=\"icon-search\">搜索</a>
    <span style=\"float: right\">
        <select class=\"easyui-combobox\" id=\"type\" name=\"type\" data-options=\"panelHeight:'auto', onSelect:reloadgrid\">
            <option value=\"1\">发表的话题</option>
            <option value=\"0\">参与的话题</option>
        </select>
    </span>
</div>
<table id=\"listdata\" class=\"easyui-datagrid\" title=\"话题列表\" data-options=\"singleSelect:false,pagination:true,method:'get',url:'";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('yii2-twig')->url("member/topic", array("id" => (isset($context["id"]) ? $context["id"] : null))), "html", null, true);
        echo "',pageSize: 20\">
    <thead>
    <tr>
        <th data-options=\"field:'subject', width:120, align:'center'\">话题</th>
        <th data-options=\"field:'name', width:400, align:'center'\">所属圈子</th>
        <th data-options=\"field:'comment_count', width:100, align:'center'\">回复</th>
        <th data-options=\"field:'created_at', width:180, align:'center'\" formatter=\"formatTime\">时间</th>
    </tr>
    </thead>
</table>

";
    }

    // line 30
    public function block_script($context, array $blocks = array())
    {
        // line 31
        echo "<script>
    function reloadgrid(){
        var queryParams = \$('#listdata').datagrid('options').queryParams;
        queryParams.startTime = \$('#startTime').datetimebox('getValue');
        queryParams.endTime\t= \$('#endTime').datetimebox('getValue');
        queryParams.type = \$('#type').combobox('getValue');
        \$('#listdata').datagrid('options').queryParams = queryParams;
        \$(\"#listdata\").datagrid('reload');
    }
    function formatTime(val, row) {
        var newDate_attend = new Date();
        newDate_attend.setTime(val * 1000);
        var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');
        return my_create_time_attend;
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "topic.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 31,  63 => 30,  47 => 17,  32 => 4,  29 => 3,  11 => 1,);
    }
}
/* {% extends '@app/views/base.html' %}*/
/* */
/* {% block main %}*/
/* <div class="search">*/
/*     <span>时间*/
/*         <input class="easyui-datetimebox" style="width:200px" name="startTime" id="startTime"> 到*/
/*         <input class="easyui-datetimebox" style="width:200px" name="endTime" id="endTime">*/
/*     </span>*/
/*     <a href="javascript:void(0);" onclick="reloadgrid();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>*/
/*     <span style="float: right">*/
/*         <select class="easyui-combobox" id="type" name="type" data-options="panelHeight:'auto', onSelect:reloadgrid">*/
/*             <option value="1">发表的话题</option>*/
/*             <option value="0">参与的话题</option>*/
/*         </select>*/
/*     </span>*/
/* </div>*/
/* <table id="listdata" class="easyui-datagrid" title="话题列表" data-options="singleSelect:false,pagination:true,method:'get',url:'{{ url('member/topic', {id: id}) }}',pageSize: 20">*/
/*     <thead>*/
/*     <tr>*/
/*         <th data-options="field:'subject', width:120, align:'center'">话题</th>*/
/*         <th data-options="field:'name', width:400, align:'center'">所属圈子</th>*/
/*         <th data-options="field:'comment_count', width:100, align:'center'">回复</th>*/
/*         <th data-options="field:'created_at', width:180, align:'center'" formatter="formatTime">时间</th>*/
/*     </tr>*/
/*     </thead>*/
/* </table>*/
/* */
/* {% endblock %}*/
/* */
/* {% block script %}*/
/* <script>*/
/*     function reloadgrid(){*/
/*         var queryParams = $('#listdata').datagrid('options').queryParams;*/
/*         queryParams.startTime = $('#startTime').datetimebox('getValue');*/
/*         queryParams.endTime	= $('#endTime').datetimebox('getValue');*/
/*         queryParams.type = $('#type').combobox('getValue');*/
/*         $('#listdata').datagrid('options').queryParams = queryParams;*/
/*         $("#listdata").datagrid('reload');*/
/*     }*/
/*     function formatTime(val, row) {*/
/*         var newDate_attend = new Date();*/
/*         newDate_attend.setTime(val * 1000);*/
/*         var my_create_time_attend=newDate_attend.format('yyyy-MM-dd hh:mm:ss');*/
/*         return my_create_time_attend;*/
/*     }*/
/* </script>*/
/* {% endblock %}*/