<?php
  include (public_path()."/storage/includes/lang1.en.php" );
?> 
@extends('layouts.app')
@section('main_content')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.min.js"></script> 

{!! Html::style('plugins/vis-4.21.0/dist/vis-network.min.css') !!} 
{!! Html::script('plugins/vis-4.21.0/dist/vis.min.js') !!}  
{!! Html::script('js/parsley.min.js') !!}  
<!-- {!! Html::style('plugins/select2/select2.full.min.css') !!}
{!! Html::script('plugins/select2/select2.full.min.js') !!}  -->  

{!! Html::style('css/fastselect.min.css') !!} 
{!! Html::script('js/fastselect.standalone.js') !!}
<style type="text/css">
.item_header {
     margin-top: 0px !important; 
     margin-bottom: 0px !important;
}

.li_active {
     border: 1px solid #3c8dbc !important;
}

.products-list .product-img {
    padding-left: 5px;
}

.action_span {
    padding-right: 5px;
    color: #333;
}
.workflow_template li { cursor: pointer; }
</style>

<style type="text/css">
    #mynetwork {
      /*width: 400px;
      height: 400px;*/
      border: 1px solid lightgray;
    }

    #stages_table thead tr {
    background-color: #fff !important;
    color: #333 !important;
}

#edges_table thead tr {
    background-color: #fff !important;
    color: #333 !important;
}


.vis-button:after {
  font-size: 2em;
  color: gray;
}

.vis-button:hover:after {
  font-size: 2em;
  color: lightgray;
}
.object_type_row{display: none;}
.full_widht{width: 100% !important;}
.fstElement {width: 100% !important;height: auto !important}
.fstControls {width: 100% !important;}


  </style>

<section class="content">
       <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">{{ Lang::get('language.workflow_new_template') }}</h3>
              <!-- <p class="help-block">{{$language['form_help1']}}</p> -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="closed_workflow_name" name="closed_workflow_name" data-parsley-validate="data-parsley-validate">
              <input type="hidden" name="workflow_id" id="workflow_id" class="workflow_id" value="{{$workflow_id}}">
              <div class="box-body">
                <div class="col-md-12 alert_space">
                  </div>
                 <div class="col-md-6">
          <div class="form-group">        
                  <ul class="products-list product-list-in-box workflow_template">
               

                 <!-- /.item -->
                <li class="item li_active wf_li" data-liid="0">
                  <div class="product-img">
                    <i class="fa fa-play fa-2x"></i>
                  </div>
                  <div class="product-info">
                    <h2 class="item_header" id="wf_name_label">&nbsp;</h2>
                  </div>
                </li>
 </ul>
</div>
 <div class="form-group">
                 <button type="button" class="btn btn-primary btn-sm add_task" data-wf_type="node"><i class="fa fa-plus"></i> Add Stage</button>
                 <button type="button" class="btn btn-primary btn-sm add_task" data-wf_type="edge"><i class="fa fa-plus"></i> Add Actions</button>

                 <button type="button" class="btn btn-warning btn-sm preview"><i class="fa fa-eye"></i> Preview</button>

                 <button type="button" class="btn btn-primary btn-sm  save_workflow">Save Template</button>
                </div>

                 </div>  

                <div class="col-md-6 li_active">
                  <div class="row right_wft_col">
                  <div class="col-md-12 taskdiv" id="rwf_div0">  
                  <h3 class="" >Workflow Details</h3>
                  <div class="form-group">
                  <label>{{$language['workflow name']}}: <span class="compulsary">*</span></label>
                   <input type="text" class="form-control" id="workflow_name" name="workflow_name" required="" data-parsley-required-message="Workflow name is required" data-parsley-trigger="change focusout">
                </div>


                <div class="form-group">
                  <label>Tasks can be completed: <span class="compulsary">*</span></label>
                   <select name="workflow_flow_type" id="workflow_flow_type" class="form-control select2" required=""  data-parsley-required-message="Workflow flow type is required" data-parsley-trigger="change focusout">
                  <option value="1">In any order</option>
                  <option value="2" selected="selected"> One by one</option>
                </select>
                </div>

                <div class="form-group">
                  <label>Workflow Object Type: <span class="compulsary">*</span></label>
                   <select name="workflow_object_type" id="workflow_object_type" class="form-control select2" required=""  data-parsley-required-message="Form Workflow type is required" data-parsley-trigger="change focusout">
                  <option value="normal">Normal workflow</option>
                  <option value="form">Form  based workflow</option>
                  <option value="document">Document based workflow</option>
                </select>
                </div>


                <div class="form-group object_type_row form_row">
                  <label>Form Type: <span class="compulsary">*</span></label>
                   <select name="form_id" id="form_id" class="form-control select2">
                  <option value="">Select</option>
                </select>
                </div>

                <div class="form-group object_type_row document_row">
                  <label>Document Type: <span class="compulsary">*</span></label>
                   <select name="document_id" id="document_id" class="form-control select2">
                  <option value="">Select</option>
                </select>
                </div>
                

                <div class="form-group">
                  <label>{{$language['color']}}: <span class="compulsary">*</span></label>
                  <div id="cp2" class="input-group colorpicker-component" title="Using input value">
                    <input type="text" name="color" id="workflow_color" class="form-control" value="#C0C0C0" readonly="" />
                    <span class="input-group-addon"><i></i></span>
                  </div>
                </div>

                <div class="form-group">
                  <label>Workflow Mangers : <i class="fa fa-info-circle" title="User who can manage all process started using this template.Workflow Mangers will have access to all process data"></i></label>
                  <div class="full_widht" id="clear_departmrnt">
                    <select name="wf_managers0" id="wf_managers0" class="form-control wf_managers" multiple="multiple" style="width:100%;" data-count="0">

                    @php foreach ($departments as $key => $role){ @endphp
                                  <option value="{{$role->department_id}}">{{$role->department_name }}</option>
                    @php } @endphp             
                  
                </select>
                </div>

                <div class="full_widht" id="clear_user0">
                   
                </div>
                
                </div>

                <div class="form-group" style="display: none;">
                  <label>Workflow deadline: </label>
                   <select name="deadline" id="deadline" class="form-control select2" >
                  <option value="0" selected="selected">Note Set</option>
                  <option value="1" > After workflow start</option>
                </select>
                </div>

                <div class="form-group" style="display: none;">
                 <div class="row"> 
                 <div class="col-md-4">
                  <input type="text" class="form-control" id="deadline_value" name="deadline_value" >
                 </div>

                 <div class="col-md-8">
                  <select name="deadline_type" id="deadline_type" class="form-control select2">
                  <option value="day" selected="selected">Days</option>
                  <option value="week" >Weeks</option>
                  <option value="month" >Months</option>
                </select>
                 </div>
               </div>
                </div>

               
        
              </div>   <!-- COL 12 --> 

              </div> <!-- ROW -->

              <div class="row right_wft_col">
                  <div class="col-md-12" id="" style="padding-bottom: 5px;"> 
                    <h3 class="">Preview</h3>

                    <div id="mynetwork"></div>
                  </div>
              </div>

                </div>
               </div> 
            </form>
          </div>
      </section>
   

    {!! Html::script('js/jquery-ui.min.js') !!}

    <script>



 $(document).ready(function() {
var departments_options='';
  @php foreach ($departments as $key => $role){ @endphp
departments_options += @php echo "'<option value=\"$role->department_id\">$role->department_name</option>'"; @endphp;
  @php } @endphp             
  var stage_color = $("#workflow_color").val(); 
  var workflow_id = $('#workflow_id').val();  
  var stage_option = '<option value="">Select a stage</option>';
  var taskcount = 0;
  var nodes, edges, network,nodecount,edgecount,stage_color;
  var nodelabels = [];
  var nodecount = 0; var edgecount = 0;
  var wf_object_type_id='';
  var departments = department_users = '';
  $(".add_new_transition").hide();
  $('#cp2').colorpicker({
            format: 'hex'
        }).on('change',
            function(ev) {
                //console.log(ev);
                if(stage_color != ev.target.value)
                {

                }
                /*stage_color = ev.target.value;*/
            });
  var nodeset = [];
  var nodes = new vis.DataSet(nodeset);

  var edgeset = [];
  var edges = new vis.DataSet(edgeset);

  // create a network
  var container = document.getElementById('mynetwork');
  var data = {
    nodes: nodes,
    edges: edges
  };
  var options = {
  height: '600px',
  width: '100%',
  layout: {
    randomSeed: undefined,
    improvedLayout:true,
    hierarchical: {
      enabled:false,
      levelSeparation: 150,
      nodeSpacing: 100,
      treeSpacing: 200,
      blockShifting: true,
      edgeMinimization: true,
      parentCentralization: true,
      direction: 'UD',        // UD, DU, LR, RL
      sortMethod: 'hubsize'   // hubsize, directed
    }
  },
  interaction: {
          navigationButtons: true
      }
  }
  var network = new vis.Network(container, data, options);network.fit();
  
   var addTask = function(task) 
   {
          
      var id=task.id;
          var wfTRHTML =''; 
      var wf_type = task.type;
      var dbid = task.dbid;
      if(wf_type == 'edge')
      {
        addAction(task);
      }
      sel_departments = task.sel_departments;
      sel_department_users = task.sel_department_users;
      department_users = task.department_users;
      /*console.log(sel_departments);
      console.log(sel_department_users);*/

          wfTRHTML +='<li class="item wf_li" data-liid="'+id+'" id="wf_li'+id+'" data-wf_type="'+wf_type+'">';
          wfTRHTML +='<div class="product-img">';
       wfTRHTML +='<i class="fa fa-list fa-2x"></i>';
      
         /* wfTRHTML +='&nbsp; <i class="fa  fa-sort fa-2x"></i>';*/
          wfTRHTML +='</div>';
          wfTRHTML +='<div class="product-info">';
          wfTRHTML +='<a href="javascript:void(0)" class="product-title" id="label'+id+'">'+task.label+'</a><span class="pull-right action_span"><i class="fa fa-trash-o fa-2x deleteState" data-liid="'+id+'"></i></span>';
         
          wfTRHTML +='</div>';
          wfTRHTML +='</li>'; 
          $('.workflow_template').append(wfTRHTML); 

          var wfTLHTML =''; 
          wfTLHTML +='<div class="col-md-12 taskdiv" id="rwf_div'+id+'" style="display:none;">';  
          wfTLHTML +='<h3 class="">Stage: '+task.label+'</h3>';
          wfTLHTML +='<div class="form-group">';
          wfTLHTML +='<label>Stage Name</label>';
          wfTLHTML +='<input type="text" class="form-control task_label_input" id="task_label'+id+'" name="task_label[]" value="'+task.label+'" data-count="'+id+'" data-wf_type="'+wf_type+'">';
         wfTLHTML +='</div>';

         wfTLHTML +='<div class="form-group">';
          wfTLHTML +='<label>Stage Description</label>';
          wfTLHTML +='<textarea class="form-control" id="task_details" name="task_details[]">'+task.description+'</textarea>';
         wfTLHTML +='</div>';



        var departments_options='';
        /*console.log(sel_departments);*/
        @php foreach ($departments as $key => $role){ @endphp

         /*var selected = '';
                  var user_id = "@php echo $role->department_id; @endphp";
                  department_id = user_id.toString();
                  if($.inArray(department_id, sel_departments) !== -1)
                  {
                    var selected = 'selected="selected"';

                  } 
                  console.log("uuuu"+id+""+department_id);
                  
                  console.log("selected"+selected);*/
        departments_options += @php echo "'<option value=\"$role->department_id\">$role->department_name</option>'"; @endphp;
        @php } @endphp 

         wfTLHTML +='<div class="form-group">';
          wfTLHTML +='<label>Assigned users</label>';
          wfTLHTML +='<div class="full_widht" id="clear_departmrnt'+id+'">';
          wfTLHTML +='<select name="wf_managers'+id+'" id="wf_managers'+id+'" class="form-control wf_managers" multiple="multiple" style="width:100%;" data-count="'+id+'">'+departments_options+'</select>';
          wfTLHTML +='</div>';
         wfTLHTML +='<div class="full_widht" id="clear_user'+id+'"></div>'; 
         wfTLHTML +='</div>';

         

          wfTLHTML +='</div>';
          $('.right_wft_col').append(wfTLHTML); 
          $('#wf_managers'+id).fastselect({
      placeholder: 'Select department',
      loadOnce: false
  });

          

          $.each(sel_departments, function(i, item)
        {
          /*console.log(item);*/
         $('#wf_managers'+id).data('fastselect').setSelectedOption($('#wf_managers'+id+' option[value='+item+']').get(0));
         $("#wf_managers"+id).val(item);  
        });

       var users_options= {sel_count:id,department_users: department_users, sel_department_users: sel_department_users}


        wf_manager_users(users_options);
      nodes.add({
                    id: id,
                    dbid:dbid,
                    label: task.label,
                    shape: 'box',
                    color:task.color,
                    sel_departments:sel_departments,
                    sel_department_users:sel_department_users
                });
          

          return wfTLHTML;
   } 


  var addAction = function(task) 
   {
          
      var id=task.id;
          var wfTRHTML =''; 
      var wf_type = task.type;
      var dbid = task.dbid;

    var stage_option = '<option value="">Select</option>';
    var response = nodes.get();
    $.each(response, function(i, item) {
      stage_option += '<option value="' + item.id + '">' + item.label + '</option>';
      
       });
     
      
          wfTRHTML +='<li class="item wf_li" data-liid="'+id+'" id="wf_li'+id+'" data-wf_type="'+wf_type+'">';
          wfTRHTML +='<div class="product-img">';
      wfTRHTML +='<i class="fa fa-exchange fa-2x"></i>';
         /* wfTRHTML +='&nbsp; <i class="fa  fa-sort fa-2x"></i>';*/
          wfTRHTML +='</div>';
          wfTRHTML +='<div class="product-info">';
          wfTRHTML +='<a href="javascript:void(0)" class="product-title" id="label'+id+'">'+task.label+'</a><span class="pull-right action_span"><i class="fa fa-trash-o fa-2x deleteAction" data-liid="'+id+'"></i></span>';
      var flow ='<label id="label_stage'+id+'">----- ->  ------</label>';
         var from_node = nodes.get(task.from);  
         var to_node = nodes.get(task.to);
         if(from_node && to_node)
        {
           var flow =from_node.label+' -> '+to_node.label;
        }
      wfTRHTML +='<span class="product-description">'+flow+'</span>';
          wfTRHTML +='</div>';
          wfTRHTML +='</li>'; 
          $('.workflow_template').append(wfTRHTML); 

          var wfTLHTML =''; 
          wfTLHTML +='<div class="col-md-12 taskdiv" id="rwf_div'+id+'" style="display:none;">';  
          wfTLHTML +='<h3 class="">Action: '+task.label+'</h3>';
          wfTLHTML +='<div class="form-group">';
          wfTLHTML +='<label>Action Name</label>';
          wfTLHTML +='<input type="text" class="form-control task_label_input" id="task_label'+id+'" name="task_label[]" value="'+task.label+'" data-count="'+id+'" data-wf_type="'+wf_type+'">';
         wfTLHTML +='</div>';

        wfTLHTML +='<div class="form-group">';
        wfTLHTML +='<label>From Stage:<span class="compulsary">*</span></label>';
        wfTLHTML +='<select name="from_satge" id="from_satge'+id+'" class="form-control select2 stages_option stages_option'+id+'" data-edgeid="'+id+'">';
        wfTLHTML +=stage_option;         
        wfTLHTML +='</select>';
        wfTLHTML +='</div>';


        wfTLHTML +='<div class="form-group">';
        wfTLHTML +='<label>To Stage:<span class="compulsary">*</span></label>';
        wfTLHTML +='<select name="to_satge" id="to_satge'+id+'" class="form-control select2 stages_option stages_option'+id+'" data-edgeid="'+id+'">';
        wfTLHTML +=stage_option;            
        wfTLHTML +='</select>';
        wfTLHTML +='</div>';

         wfTLHTML +='<div class="form-group">';
          wfTLHTML +='<label>Action Description</label>';
          wfTLHTML +='<textarea class="form-control" id="task_details" name="task_details[]">'+task.description+'</textarea>';
         wfTLHTML +='</div>';

          wfTLHTML +='</div>';
          $('.right_wft_col').append(wfTLHTML); 
          
          $('#from_satge'+id).val(task.from);
          $('#to_satge'+id).val(task.to);
      
      edges.add({
                      id: id,
                      dbid:dbid,
                      label:task.label,
                      from: task.from,
                      to: task.to,
                      arrows:'to'
                  });

          return wfTLHTML;
   }
   /* Load work flow template */
  var loadWorkflowtemplate = function(wf) 
   {
      var loadformurl = "@php echo URL('load_Workflow_json'); @endphp";
      console.log("loadformurl"+loadformurl);
      $.getJSON(loadformurl+'?workflow_id=' + wf, function(data) {
        taskcount = data.taskcount;

        edgecount = data.edgecount;
        var workflow_name =data.workflow_name;
        stage_color =data.workflow_color;
        var nodeset = data.wf_states;
        var edgeset = data.wf_transitions;
        var task_flow = data.task_flow;

        var wf_object_type = data.wf_object_type;
        wf_object_type_id = data.wf_object_type_id;
        var deadline = data.deadline;
        var deadline_type = data.deadline_type;
        var deadline_value = data.deadline_value;
        sel_departments = data.sel_departments;
        sel_department_users = data.sel_department_users;


        var wf_name_label = "Workflow Start";
        if(workflow_name != '')
        {
            wf_name_label = workflow_name;
        }
        $("#wf_name_label").html(wf_name_label);   
        

        $("#workflow_name").val(workflow_name); 
        $("#workflow_color").val(stage_color);
        $("#workflow_color").trigger('change');
        $("#workflow_flow_type").val(task_flow);

        $("#workflow_object_type").val(wf_object_type);

        $(".object_type_row").slideUp();  
        if(wf_object_type == 'form')
        {
         $(".form_row").slideDown();
        }
        if(wf_object_type == 'document')
        {
         $(".document_row").slideDown();
        }
        
        $("#deadline").val(deadline);
        $("#deadline_type").val(deadline_type);
        $("#deadline_value").val(deadline_value);

     
        $.each(sel_departments, function(i, item)
        {
          console.log(item);
         $('#wf_managers0').data('fastselect').setSelectedOption($('#wf_managers0 option[value='+item+']').get(0));
         //$("#wf_managers0").val(item);  
        });
		$("#wf_managers0").val(sel_departments);  
       var users_options= {sel_count:0,department_users: data.department_users, sel_department_users: sel_department_users}

        wf_manager_users(users_options);

        $.each(nodeset, function(i, item)
        {
          console.log(item);
          var taskhtml = addTask(item);
          taskcount++;   
        });
    console.log('--------------------');
     $.each(edgeset, function(i, item)
        {
          
          console.log(item);
          var taskhtml = addAction(item);
          taskcount++;   
        });
        load_workflow_objects();
     //nodes.add(nodeset);
         //edges.add(edgeset);
    
      //$('#wf_managers').fastselect();
        
      });
   };      
   loadWorkflowtemplate(workflow_id);

   $(document).on("click",".wf_li",function(e) {
       var liid =$(this).attr('data-liid'); 
     var wf_type =$(this).attr('data-wf_type'); 
       console.log(liid);
       $(".taskdiv").hide();
       $("#rwf_div"+liid).show();
        $(".wf_li").removeClass("li_active");
        $(this).addClass("li_active");
  if(wf_type == 'edge')
  {   
  var from_satge = $("#from_satge"+liid).val(); 
  var to_satge = $("#to_satge"+liid).val(); 
  console.log("from_satge"+from_satge+"to_satge"+to_satge);
    var stage_option = '<option value="">Select</option>';
    var response = nodes.get();
    $.each(response, function(i, item) {
      stage_option += '<option value="' + item.id + '">' + item.label + '</option>';
      
       });
      $('.stages_option'+liid).html(stage_option);
    $("#from_satge"+liid).val(from_satge); 
    $("#to_satge"+liid).val(to_satge); 
  }
     });

   $(document).on("click",".preview",function(e) {
        $(".taskdiv").hide();
        $("#preview_div").show();
        $(".wf_li").removeClass("li_active");
     });

    $(document).on("click",".add_task",function(e) {
    
    taskcount++;
    var wf_type =$(this).attr('data-wf_type'); 
    
    if(wf_type == 'edge')
    {
      var label='Action';
      var task= {id: taskcount, dbid: 0, label: label, type: wf_type, from: 0, to: 0, description:''}
        addAction(task);
    }
    else
    {
      var label='Stage';
      var empty=[];
      var task= {id: taskcount, dbid: 0, label: label, shape: "box", color: "#c0c0c0", type: wf_type, description:'',department_users:empty,sel_departments:empty,sel_department_users:empty}
      addTask(task);
    }
        
    $( "#wf_li"+taskcount).trigger( "click" );
     });
   
    $(document).on("change keyup paste input",".task_label_input",function(e) {
    try {
                var stage_id = $(this).attr('data-count');  
        var label = $('#task_label'+stage_id).val();
        var wf_type =$(this).attr('data-wf_type'); 
    
    if(wf_type == 'edge')
    {
      edges.update({
                    id: stage_id,
                    label: label
                });
    }
    else
    {
      nodes.update({
                    id: stage_id,
                    label: label
                });
    }
        $("#label"+stage_id).html(label);
            }
            catch (err) {
                alert(err);
            }
      
     });
   
   $(document).on("change",".stages_option",function(e) {
    try {
                var edge_id = $(this).attr('data-edgeid');  
        console.log("edge_id"+edge_id);
        var from_satge = $('#from_satge'+edge_id).val(); 
        var to_satge = $('#to_satge'+edge_id).val();
        var from_satge_name = $("#from_satge"+edge_id+" option:selected").text();
        var to_satge_name = $("#to_satge"+edge_id+" option:selected").text();
        if(from_satge && to_satge)
        {
        edges.update({
                      id: edge_id,
                      dbid:0,
                      label:$('#task_label'+edge_id).val(),
                      from: from_satge,
                      to: to_satge,
                      arrows:'to'
                  });
          $('#label_stage'+edge_id).html(from_satge_name+' -->'+to_satge_name);
          
        }
            }
            catch (err) {
                alert(err);
            }
      
     });


     $(document).on("click",".deleteState",function(e) {
       var node_id =$(this).attr('data-liid'); 

       swal({
        title:"{{$language['confirm_delete']}}",
        showCancelButton: true
        }).then((result) => {
        if(result){
         nodes.remove({id: node_id});
          $("#wf_li"+node_id).remove();
        }
        else
        {
          //stay in same stage
        }
     });
      
     
     }); 

     $(document).on("click",".deleteAction",function(e) {
       var edge_id =$(this).attr('data-liid'); 

       swal({
        title:"{{$language['confirm_delete']}}",
        showCancelButton: true
        }).then((result) => {
        if(result){
         edges.remove({id: edge_id});
                $("#wf_li"+edge_id).remove();
        }
        else
        {
          //stay in same stage
        }
     });
      
     
     }); 

     


     $(document).on("change keyup paste input","#workflow_name",function(e) {
            var label = $(this).val();
            $("#wf_name_label").html(label);
      
     });

        ///OLD
 
  
    var s = $("#sticker");
    var pos = s.position();                    
   
  

  
 // console.log(" Scale "+network.getScale());
    
 
   var addNewState = function(newstate) 
   {
    nodecount++;
    try {
    var newtrHTML ='';
  var stage_id = nodecount; 
  var data_options ='data-stage="'+stage_id+'" data-edge=""  data-edge_label="Next" data-edge_from="'+stage_id+'" data-edge_to=""';
      newtrHTML += '<tr id="tr-'+stage_id+'"><td>1</td>';
      newtrHTML += '<td><input class="form-control input-sm stage_label" id="stage_label_'+stage_id+'" type="text" value="'+newstate+'" '+data_options+'></td>';
      newtrHTML += '<td>';
      /*newtrHTML += '<i class="fa fa-plus Addtransition" '+data_options+'></i> &nbsp; &nbsp;';*/
      newtrHTML += '<i class="fa fa-trash deleteState" '+data_options+'></i></td></tr>'; 
      $('#stages_table').append(newtrHTML);  

                /*nodes.add({
                    id: nodecount,
                    dbid:0,
                    label: newstate,
                    shape: 'box',
                    color:stage_color
                });*/
                return json = {}
            }
            catch (err) {
                alert(err);
            }
    
   }; 

  var DrawTabale = function() 
   {
   // nodeset = [];
   $("#stages_table > tbody").empty();
    var response = nodes.get();
    var trHTML = '';
    $.each(response, function(i, item) {
    var stage_id = item.id; 
    var data_options ='data-stage="'+stage_id+'" data-edge="" data-edge_label="Next" data-edge_from="'+stage_id+'" data-edge_to=""';
      trHTML += '<tr id="tr-'+stage_id+'"><td>' + item.id + '</td>';
      trHTML += '<td><input class="form-control input-sm stage_label" id="stage_label_'+stage_id+'" type="text" value="' + item.label + '" '+data_options+'></td>';
      trHTML += '<td>';

      /*trHTML += '<i class="fa fa-plus Addtransition" '+data_options+'></i> &nbsp; &nbsp;';*/
      trHTML += '<i class="fa fa-trash deleteState" '+data_options+'></i> </td></tr>';
       nodelabels[item.id] = item.label;
       });
    //console.log(trHTML);
    if(trHTML == '')
    {
      /*addNewState('Stage 1');
      addNewState('Stage 2');*/
      network.fit();
    }
    else
    {
      $('#stages_table').append(trHTML);
    }

      
     };

    
     
     

    var DrawEdges = function() 
   {
   // nodeset = [];
   $("#edges_table > tbody").empty();
    var response = edges.get();
    var trHTML = '';
    
    $.each(response, function(i, item) {
   // console.log(item);
    var from_node = nodes.get(item.from); 
    var to_node = nodes.get(item.to);
    if(from_node && to_node)
    {
      var data_options ='data-stage="'+item.from+'" data-edge="'+item.id+'" data-edge_label="'+item.label+'" data-edge_from="'+item.from+'" data-edge_to="'+item.to+'"'; 
      trHTML += '<tr id="tr-'+item.id+'"><td>' + item.id + '</td>';
      trHTML += '<td>'+item.label+'</td>';
      trHTML += '<td>'+from_node.label+'</td>';
      trHTML += '<td>'+to_node.label+'</td>';
      trHTML += '<td><i class="fa fa-edit Addtransition" '+data_options+'></i> &nbsp;&nbsp;<i class="fa fa-trash deleteEdge" '+data_options+'></i> </td></tr>';
    }
       });
    
      $('#edges_table').append(trHTML);
    

      
     };

    
     
     


     var loadWorkflow = function(wf) 
   {
      var loadformurl = "@php echo URL('load_Workflow_json'); @endphp";
      //console.log("loadformurl"+loadformurl);
      $.getJSON(loadformurl+'?workflow_id=' + wf, function(data) {
        nodecount = data.nodecount;
        edgecount = data.edgecount;
        var workflow_name =data.workflow_name;
        stage_color =data.workflow_color;
        var nodeset = data.wf_states;
        var edgeset = data.wf_transitions;
        $("#workflow_name").val(workflow_name); 
        $("#workflow_color").val(stage_color);
        /*var nodes = new vis.DataSet(nodeset);stage_color
        var edges = new vis.DataSet(edgeset);
        var container = document.getElementById('mynetwork');
        var data = { nodes: nodes,edges: edges};
  
        var options = {
                        height: '600px',
                        width: '100%'
        }
        var network = new vis.Network(container, data, options);network.fit();*/

        //nodes.add(nodeset);
        //edges.add(edgeset);

        DrawTabale();
        DrawEdges();
      });
   };
   //loadWorkflow(workflow_id);

     $(document).on("click",".addNewState",function(e) {

       addNewState('Stage');
     });

     

     $(document).on("click",".deleteEdge",function(e) {
       var edge_id =$(this).attr('data-edge'); 
        try {
              //  console.log(edge_id);
                edges.remove({id: edge_id});
                DrawEdges();
            }
            catch (err) {
                alert(err);
            }
            
     });

  var deleteState = function(node_id) 
   {
      
      try {
                nodes.remove({id: node_id});
                $("#tr-"+node_id).remove();
            }
            catch (err) {
                alert(err);
            }
    
   }; 

   $(document).on("click",".Addtransition",function(e) {
//console.log(nodes.get());
   // console.log(edges.get());
    var satge_id =$(this).attr('data-stage');
    var edge_id =$(this).attr('data-edge'); 
    var edge_from =$(this).attr('data-edge_from');
    var edge_to =$(this).attr('data-edge_to');
    var transition_name = $(this).attr('data-edge_label');
$('#activity_modal').modal({
                     show: 'show',
                     backdrop: false
               });
    var stage_option = '<option value="">Select</option>';
    var response = nodes.get();
    $.each(response, function(i, item) {
      stage_option += '<option value="' + item.id + '">' + item.label + '</option>';
      
       });
      $('.stages_option').html(stage_option);
      $('#transition_name').val(transition_name);
      $('#from_satge').val(edge_from);
      $('#to_satge').val(edge_to);
      $('#edge_id').val(edge_id);
      $('#add_transition').parsley().reset();
      load_transition_add();
     });
    $(document).on("change keyup paste input",".stage_label",function(e) {
   
    
    try {
                var stage_id = $(this).attr('data-stage');  
        //console.log("save 122"+stage_id);
         nodes.update({
                    id: stage_id,
                    label: $('#stage_label_'+stage_id).val()
                });
        
        DrawEdges();
            }
            catch (err) {
                alert(err);
            }
      
     });

   $(document).on("click",".save_workflow",function(e) {
   e.preventDefault();
   
   if($("#closed_workflow_name").parsley().validate())
   {
    console.log("save");
        var fields='';
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var form_url = "@php echo URL('save_closed_workflow'); @endphp";
        var workflow_id = $('#workflow_id').val();
        var departments = $('#wf_managers0').val();
        var department_users = $('#wf_manager_users0').val();

        /*var data = JSON.stringify([{_token:CSRF_TOKEN},{"name":"formID","value":formID},{"name":"formFields","value":fields}]);*/
        var data = {_token: CSRF_TOKEN,"workflow_id":workflow_id,"workflow_name":$('#workflow_name').val(),"workflow_color":$('#workflow_color').val(),"task_flow":$('#workflow_flow_type').val(),"workflow_object_type":$('#workflow_object_type').val(),"form_id":$('#form_id').val(),"document_id":$('#document_id').val(),"workflow_stages":nodes.get(),"workflow_edges":edges.get(),"deadline":$('#deadline').val(),"deadline_value":$('#deadline_value').val(),"deadline_type":$('#deadline_type').val(),"departments":departments,"department_users":department_users};
       // console.log(data);
        
        $.ajax({
            method: "POST",
            url: form_url,
            data: data,
            dataType: 'json',
            success: function (msg) {
              //  console.log(msg);
                $('.alert_space').html(msg.message);
                if(msg.status == 1)
                {
                        workflow_id = msg.workflow_id;
                        $('#closed_workflow_name').parsley().reset();
                       /* if(return_form == 'save_close')
                        {
                          window.location.href = return_form_url;      
                        }*/

                }
                
                $("html, body").animate({ scrollTop: 0 }, "fast");

                //Demo only
                //$('.alert textarea').val(JSON.stringify(fields));
            }
        });
    
   }
   else
   {
     console.log("Validation failed");
   }

     });
   
   
    $(document).on("click",".save_transition",function(e) {
   e.preventDefault();
   
   if($("#add_transition").parsley().validate())
   {
    //console.log("save");
    try {
                var edge_id = $('#edge_id').val();
                if(edge_id)
                {
                  edges.update({
                      id: edge_id,
                      dbid:0,
                      label:document.getElementById('transition_name').value,
                      from: document.getElementById('from_satge').value,
                      to: document.getElementById('to_satge').value,
                      arrows:'to'
                  });
                }
                else
                {
                  edgecount++;
                  edges.add({
                      id: edgecount,
                      dbid:0,
                      label:document.getElementById('transition_name').value,
                      from: document.getElementById('from_satge').value,
                      to: document.getElementById('to_satge').value,
                      arrows:'to'
                  });
                  $('#edge_id').val(edgecount);
                }
                
                DrawEdges();
                load_transition_add();
            }
            catch (err) {
                alert(err);
            }
   }

     });


    var load_transition_add = function() 
   {
    var edge_id = $('#edge_id').val();
    //console.log("edge_id"+edge_id); 
    if(edge_id)
    {
       $(".add_new_transition").show();

    }
    else
    {
       $(".add_new_transition").hide();

    }  
      
    
   }; 

   load_transition_add();

   $(document).on("click",".add_new_transition",function(e) { 


      $('#transition_name').val('Next');
      $('#from_satge').val('');
      $('#to_satge').val('');
      $('#edge_id').val('');
      $('#add_transition').parsley().reset();
      load_transition_add();

     });

   $(document).on("change","#workflow_object_type",function(e) {
    var wf_object_type=  $(this).val();
     //console.log(wf_object_type);
     $(".object_type_row").slideUp();
    
     $('#form_id').attr('data-parsley-required', 'false');
     $('#document_id').attr('data-parsley-required', 'false');
     if(wf_object_type == 'form')
     {
        $(".form_row").slideDown();
        $('#form_id').attr('data-parsley-required', 'true');
        $('#form_id').attr('data-parsley-required-message', 'Form Type is required');
     }

     if(wf_object_type == 'document')
     {
        $(".document_row").slideDown();
        $('#document_id').attr('data-parsley-required', 'true');
        $('#document_id').attr('data-parsley-required-message', 'Document Type is required');
     }

       if(wf_object_type == 'form' || wf_object_type == 'document')
       {  
        load_workflow_objects();
       }

   });  


    var load_workflow_objects = function() 
   {
        var wf_object_type = $('#workflow_object_type').val();
        var form_url = "@php echo URL('load_workflow_objects'); @endphp";
        var data = {"wf_object_type":wf_object_type};
        $.ajax({
            method: "GET",
            url: form_url,
            data: data,
            dataType: 'json',
            success: function (msg) 
            {
                if(msg.status == 1)
                {
                        
                   var stage_option = '<option value="">Select</option>';
    
    $.each(msg.wf_objects, function(i, item) {
      var selected='';
      console.log("wf_object_type_id"+wf_object_type_id);
      if(wf_object_type_id == item.object_id)
      {
        
        selected='selected="selected"';
      }
      stage_option += '<option value="' + item.object_id + '" ' + selected + '>' + item.object_name + '</option>';
      
       });

                   if(wf_object_type == 'form')
                  {  
                       $('#form_id').html(stage_option);
                  }
                  else if(wf_object_type == 'document')
                  {  
                       $('#document_id').html(stage_option);
                  }

                }
              
            }
        });
    
   }; 

   
   $('#wf_managers0').fastselect({
      placeholder: 'Select department',
      loadOnce: false
  });
  //  $('#wf_manager_users').fastselect(); 

  var wf_manager_users = function(task) 
   {
   
    department_users = task.department_users;
    selectedusers = task.sel_department_users;
    sel_count = task.sel_count;
    var users_option = '<select name="wf_manager_users'+sel_count+'" id="wf_manager_users'+sel_count+'" class="form-control wf_manager_users" multiple="multiple" data-count="'+sel_count+'">';
    console.log(department_users);
    $.each(department_users, function(i, item) {
      
      var user_permission = item.user_permission;
      var workflow_module='workflow';
      if(user_permission.indexOf(workflow_module) != -1)
      {
                  var selected = '';
                  /*console.log('id'+item.id);*/
                  var user_id = item.id.toString();
                  if($.inArray(user_id, selectedusers) !== -1)
                  {
                    var selected = 'selected="selected"';

                  }
                  /*console.log('selected'+selected);*/
                  users_option += '<option value="' + item.id + '" '+selected+'>' + item.user_full_name+'</option>';
                  /*console.log("----"+item.user_full_name+"-----");*/
      }
                });
                
                users_option += '</select>';
                /*console.log(users_option);*/
                $('#clear_user'+sel_count).html(users_option);
                $('#wf_manager_users'+sel_count).fastselect(); 
   };

    $(document).on("change",".wf_managers",function(e) {
    
        console.log("div"+$(this).attr("data-count"));
        var sel_count = $(this).attr("data-count");
        var departments = $(this).val();
        console.log(departments);
        var sel_department_users = $('#wf_manager_users'+sel_count).val();
        console.log(department_users);
        var form_url = "@php echo URL('load_department_users'); @endphp";
        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var data = {_token: CSRF_TOKEN,"departments":departments};
        $.ajax({
            method: "POST",
            url: form_url,
            data: data,
            dataType: 'json',
            success: function (msg) 
            {
                
                if(msg.status == 1)
                {
                 var users_options= {sel_count:sel_count,department_users: msg.department_users, sel_department_users: sel_department_users}
                wf_manager_users(users_options);

                if(sel_count != 0)
                {
                  console.log("update edge");
                  nodes.update({
                    id: sel_count,
                    sel_departments: departments
                });
                }
                }
              
            }
        });
     });

    $(document).on("change",".wf_manager_users",function(e) {
    
        console.log("div"+$(this).attr("data-count"));
        var sel_count = $(this).attr("data-count");
        var departments_users = $(this).val();
        if(sel_count != 0)
                {
                  console.log("update edge");
                  nodes.update({
                    id: sel_count,
                    sel_department_users: departments_users
                });
                }
     });
  });

  
</script>
   
  @endsection
