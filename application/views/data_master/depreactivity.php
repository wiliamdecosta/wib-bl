<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Data Master</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Depreciation Activity</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <table id="grid-table"></table>
        <div id="grid-pager"></div>
    </div>
</div>


<?php $this->load->view('lov/lov_business_unit'); ?>
<?php $this->load->view('lov/lov_depreciation'); ?>
<?php $this->load->view('lov/lov_cost_driver'); ?>


<script>
/**
 * [showLOVBusinessUnit called by input menu_icon to show List Of Value (LOV) of icon]
 * @param  {[type]} id   [description]
 * @param  {[type]} code [description]
 * @return {[type]}      [description]
 */
function showLOVBusinessUnit(id, code) {
    modal_lov_business_unit_show(id, code);
}

function showLOVDepreciation(id, code) {
    modal_lov_depreciation_show(id, code);
}

function showLOVCostDriver(id, code) {
    modal_lov_cost_driver_show(id, code);
}

/**
 * [clearInputBusinessUnit called by beforeShowForm method to clean input of businesscostdriverid_fk]
 * @return {[type]} [description]
 */
function clearInputBusinessUnit() {
    $('#form_businesscostdriverid_fk').val('');
    $('#form_businessunitcode').val('');
}

function clearInputDepreciation() {
    $('#form_depreciationid_fk').val('');
    $('#form_depreciationcode').val('');
}

function clearInputCostDriver() {
    $('#form_costdriverid_fk').val('');
    $('#form_costdrivercode').val('');
}


</script>

<script>

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."data_master.depreactivity_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 'depreactivityid_pk', key: true, width: 100, sorttype: 'number', editable: true, hidden: true},
                {label: 'Business Unit', name: 'businessunitcode', width: 150,  editable: false, search:false, sortable:false},
                {label: 'Business Unit',
                    name: 'businesscostdriverid_fk',
                    width: 200,
                    sortable: true,
                    editable: true,
                    hidden: true,
                    editrules: {edithidden: true, required:false},
                    edittype: 'custom',
                    editoptions: {
                        "custom_element":function( value  , options) {
                            var elm = $('<span></span>');

                            // give the editor time to initialize
                            setTimeout( function() {
                                elm.append('<input id="form_businesscostdriverid_fk" type="text"  style="display:none;">'+
                                        '<input id="form_businessunitcode" readonly type="text" class="FormElement form-control" placeholder="Choose Business Unit">'+
                                        '<button class="btn btn-success" type="button" onclick="showLOVBusinessUnit(\'form_businesscostdriverid_fk\',\'form_businessunitcode\')">'+
                                        '   <span class="fa fa-search bigger-110"></span>'+
                                        '</button>');
                                $("#form_businesscostdriverid_fk").val(value);
                                elm.parent().removeClass('jqgrid-required');
                            }, 100);

                            return elm;
                        },
                        "custom_value":function( element, oper, gridval) {

                            if(oper === 'get') {
                                return $("#form_businesscostdriverid_fk").val();
                            } else if( oper === 'set') {
                                $("#form_businesscostdriverid_fk").val(gridval);
                                var gridId = this.id;
                                // give the editor time to set display
                                setTimeout(function(){
                                    var selectedRowId = $("#"+gridId).jqGrid ('getGridParam', 'selrow');
                                    if(selectedRowId != null) {
                                        var code_display = $("#"+gridId).jqGrid('getCell', selectedRowId, 'businessunitcode');
                                        $("#form_businessunitcode").val( code_display );
                                    }
                                },100);
                            }
                        }
                    }
                },

                {label: 'Depreciation', name: 'depreciationcode', width: 200,  editable: false, search:false, sortable:false},
                {label: 'Depreciation',
                    name: 'depreciationid_fk',
                    width: 200,
                    sortable: true,
                    editable: true,
                    hidden: true,
                    editrules: {edithidden: true, required:false},
                    edittype: 'custom',
                    editoptions: {
                        "custom_element":function( value  , options) {
                            var elm = $('<span></span>');

                            // give the editor time to initialize
                            setTimeout( function() {
                                elm.append('<input id="form_depreciationid_fk" type="text"  style="display:none;">'+
                                        '<input id="form_depreciationcode" readonly type="text" class="FormElement form-control" placeholder="Choose Depreciation">'+
                                        '<button class="btn btn-success" type="button" onclick="showLOVDepreciation(\'form_depreciationid_fk\',\'form_depreciationcode\')">'+
                                        '   <span class="fa fa-search bigger-110"></span>'+
                                        '</button>');
                                $("#form_depreciationid_fk").val(value);
                                elm.parent().removeClass('jqgrid-required');
                            }, 100);

                            return elm;
                        },
                        "custom_value":function( element, oper, gridval) {

                            if(oper === 'get') {
                                return $("#form_depreciationid_fk").val();
                            } else if( oper === 'set') {
                                $("#form_depreciationid_fk").val(gridval);
                                var gridId = this.id;
                                // give the editor time to set display
                                setTimeout(function(){
                                    var selectedRowId = $("#"+gridId).jqGrid ('getGridParam', 'selrow');
                                    if(selectedRowId != null) {
                                        var code_display = $("#"+gridId).jqGrid('getCell', selectedRowId, 'depreciationcode');
                                        $("#form_depreciationcode").val( code_display );
                                    }
                                },100);
                            }
                        }
                    }
                },


                {label: 'Cost Driver', name: 'costdrivercode', width: 200,  editable: false, search:false, sortable:false},
                {label: 'Cost Driver',
                    name: 'costdriverid_fk',
                    width: 200,
                    sortable: true,
                    editable: true,
                    hidden: true,
                    editrules: {edithidden: true, required:false},
                    edittype: 'custom',
                    editoptions: {
                        "custom_element":function( value  , options) {
                            var elm = $('<span></span>');

                            // give the editor time to initialize
                            setTimeout( function() {
                                elm.append('<input id="form_costdriverid_fk" type="text"  style="display:none;">'+
                                        '<input id="form_costdrivercode" readonly type="text" class="FormElement form-control" placeholder="Choose Unit">'+
                                        '<button class="btn btn-success" type="button" onclick="showLOVUnit(\'form_costdriverid_fk\',\'form_costdrivercode\')">'+
                                        '   <span class="fa fa-search bigger-110"></span>'+
                                        '</button>');
                                $("#form_costdriverid_fk").val(value);
                                elm.parent().removeClass('jqgrid-required');
                            }, 100);

                            return elm;
                        },
                        "custom_value":function( element, oper, gridval) {

                            if(oper === 'get') {
                                return $("#form_costdriverid_fk").val();
                            } else if( oper === 'set') {
                                $("#form_costdriverid_fk").val(gridval);
                                var gridId = this.id;
                                // give the editor time to set display
                                setTimeout(function(){
                                    var selectedRowId = $("#"+gridId).jqGrid ('getGridParam', 'selrow');
                                    if(selectedRowId != null) {
                                        var code_display = $("#"+gridId).jqGrid('getCell', selectedRowId, 'costdrivercode');
                                        $("#form_costdrivercode").val( code_display );
                                    }
                                },100);
                            }
                        }
                    }
                },

                {label: 'ISDOMTRAFFIC?',name: 'isdomtraffic',width: 120, align: "left",editable: true, edittype: 'select', hidden:false,
                    editrules: {edithidden: true, required: true},
                    editoptions: {
                    value: "Y:Yes;N:No",
                    dataInit: function(elem) {
                        $(elem).width(150);  // set the width which you need
                    }
                }},
                {label: 'ISDOMNETWORK?',name: 'isdomnetwork',width: 120, align: "left",editable: true, edittype: 'select', hidden:false,
                    editrules: {edithidden: true, required: true},
                    editoptions: {
                    value: "Y:Yes;N:No",
                    dataInit: function(elem) {
                        $(elem).width(150);  // set the width which you need
                    }
                }},
                {label: 'ISINTLTRAFFIC?',name: 'isintltraffic',width: 120, align: "left",editable: true, edittype: 'select', hidden:false,
                    editrules: {edithidden: true, required: true},
                    editoptions: {
                    value: "Y:Yes;N:No",
                    dataInit: function(elem) {
                        $(elem).width(150);  // set the width which you need
                    }
                }},
                {label: 'ISINTLNETWORK?',name: 'isintlnetwork',width: 120, align: "left",editable: true, edittype: 'select', hidden:false,
                    editrules: {edithidden: true, required: true},
                    editoptions: {
                    value: "Y:Yes;N:No",
                    dataInit: function(elem) {
                        $(elem).width(150);  // set the width which you need
                    }
                }},
                {label: 'ISINTLADJACENT?',name: 'isintladjacent',width: 120, align: "left",editable: true, edittype: 'select', hidden:false,
                    editrules: {edithidden: true, required: true},
                    editoptions: {
                    value: "Y:Yes;N:No",
                    dataInit: function(elem) {
                        $(elem).width(150);  // set the width which you need
                    }
                }},
                {label: 'ISTOWER?',name: 'istower',width: 120, align: "left",editable: true, edittype: 'select', hidden:false,
                    editrules: {edithidden: true, required: true},
                    editoptions: {
                    value: "Y:Yes;N:No",
                    dataInit: function(elem) {
                        $(elem).width(150);  // set the width which you need
                    }
                }},
                {label: 'ISINFRASTRUCTURE?',name: 'isinfrastructure',width: 120, align: "left",editable: true, edittype: 'select', hidden:false,
                    editrules: {edithidden: true, required: true},
                    editoptions: {
                    value: "Y:Yes;N:No",
                    dataInit: function(elem) {
                        $(elem).width(150);  // set the width which you need
                    }
                }},



                {label: 'Description',name: 'description',width: 200, align: "left",editable: true,
                    edittype:'textarea',
                    editoptions: {
                        rows: 2,
                        cols:50,
                        maxlength:128
                    }
                }
            ],
            height: '100%',
            autowidth: true,
            viewrecords: true,
            rowNum: 10,
            rowList: [10,20,50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: false,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            pager: '#grid-pager',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }

            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."data_master.depreactivity_controller/crud"; ?>',
            caption: "GL Category"

        });

        jQuery('#grid-table').jqGrid('navGrid', '#grid-pager',
            {   //navbar options
                edit: true,
                editicon: 'fa fa-pencil blue bigger-120',
                add: true,
                addicon: 'fa fa-plus-circle purple bigger-120',
                del: true,
                delicon: 'fa fa-trash-o red bigger-120',
                search: true,
                searchicon: 'fa fa-search orange bigger-120',
                refresh: true,
                afterRefresh: function () {
                    // some code here
                    jQuery("#detailsPlaceholder").hide();
                },

                refreshicon: 'fa fa-refresh green bigger-120',
                view: false,
                viewicon: 'fa fa-search-plus grey bigger-120'
            },

            {
                // options for the Edit Dialog
                closeAfterEdit: true,
                closeOnEscape:true,
                recreateForm: true,
                serializeEditData: serializeJSON,
                width: 'auto',
                height: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    style_edit_form(form);

                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                //new record form
                closeAfterAdd: false,
                clearAfterAdd : true,
                closeOnEscape:true,
                recreateForm: true,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                serializeEditData: serializeJSON,
                viewPagerButtons: false,
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    style_edit_form(form);

                    setTimeout(function() {
                        clearInputBusinessUnit();
                        clearInputDepreciation();
                        clearInputCostDriver();
                    },100);
                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }

                    $(".tinfo").html('<div class="ui-state-success">' + response.message + '</div>');
                    var tinfoel = $(".tinfo").show();
                    tinfoel.delay(3000).fadeOut();

                    clearInputBusinessUnit();
                    clearInputDepreciation();
                    clearInputCostDriver();

                    return [true,"",response.responseText];
                }
            },
            {
                //delete record form
                serializeDelData: serializeJSON,
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    style_delete_form(form);

                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                onClick: function (e) {
                    //alert(1);
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                //search form
                closeAfterSearch: false,
                recreateForm: true,
                afterShowSearch: function (e) {
                    var form = $(e[0]);
                    style_search_form(form);
                    form.closest('.ui-jqdialog').center();
                },
                afterRedraw: function () {
                    style_search_filters($(this));
                }
            },
            {
                //view record form
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                }
            }
        );


    });

    function responsive_jqgrid(grid_selector, pager_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );

    }

</script>