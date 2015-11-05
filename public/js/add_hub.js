/**
 * This class controls the adding / configuration of hubs
 *
 * @author Sam Mottley
 */

var add_hub = {

    subHubs: [],

    modules: [],

    init: function(){
        // Check for adding of sub hub
        this.addSubHub();

        // Check for adding modules
        this.addModule();

        // Show desc when user wants
        add_hub.openDesc();
    },

    addSubHub: function(){
        $( "#add-sub-hub" ).click(function() {
            // Validate fields (@todo improve validation later - Sam Mottley)
            if (
                ($("input[name=sub_api_key]").val().length > 0) &&
                ($("input[name=sub_api_enc]").val().length > 0) &&
                ($("input[name=sub_api_user]").val().length > 0) &&
                ($("input[name=sub_api_pass]").val().length > 0)
            ) {
                // Ensure sub hub not already added
                if(add_hub.subHubNotExsits($("input[name=sub_api_key]").val()) != false){
                    $("#sub-hub-val-failed").hide();
                    $("#sub-hubs").append( add_hub.subHubCreatePanel() );
                    add_hub.subHubAddToVar();
                    add_hub.subHubClearFields();
                }else{
                    $("#sub-hub-val-failed").show();
                }
            }else{
                $("#sub-hub-val-failed").show();
            }
        });
        add_hub.subHubDelete();
    },

    subHubCreatePanel: function(){
        return "<div class='x_panel' id='"+$("input[name=sub_api_key]").val()+"'> <div class='x_title'><h2>Sub Hub ("+$("input[name=sub_name]").val()+"...)</h2><ul class='nav navbar-right panel_toolbox' style='min-width: 25px;'><li><a class='show-content'><i class='fa fa-chevron-up'></i></a></li><li><a class='delete-sub-hub'><i class='fa fa-close'></i></a></li></ul><div class='clearfix'></div></div><div class='x_content' style='display: none;'>API Key: "+$("input[name=sub_api_key]").val()+"<br/>API Enc: "+$("input[name=sub_api_enc]").val()+"<br/>API User: "+$("input[name=sub_api_pass]").val()+"<br/></div></div>";
    },

    subHubClearFields: function(){
        $("input[name=sub_name]").val("");
        $("input[name=sub_api_key]").val("");
        $("input[name=sub_api_enc]").val("");
        $("input[name=sub_api_user]").val("");
        $("input[name=sub_api_pass]").val("");
    },

    openDesc: function(){
        $( document  ).on('click', '.show-content', function() {
            $("#"+$( this ).parents().eq(3).attr("id")+" .x_content").toggle();
        });
    },

    subHubDelete: function(){
        $( document  ).on('click', '.delete-sub-hub', function() {
            var api = $( this ).parents().eq(3).attr("id");
            $("#"+api).remove();
            add_hub.subHubDeleteFromVar(api);
        });
    },

    subHubAddToVar: function(){
        var subHub = {}
        subHub["name"] = $("input[name=sub_name]").val();
        subHub["api_key"] = $("input[name=sub_api_key]").val();
        subHub["api_enc"] = $("input[name=sub_api_enc]").val();
        subHub["api_user"] = $("input[name=sub_api_user]").val();
        subHub["api_pass"] = $("input[name=sub_api_pass]").val();

        add_hub.subHubs.push(subHub);

        add_hub.updateModuleDropDown();
    },

    subHubDeleteFromVar: function(api){
        var data = add_hub.subHubs;
        add_hub.subHubs = data.filter(function (find) {
            return find.api_key !== api;
        });
        add_hub.updateModuleDropDown();
        add_hub.deleteModulesWithNoParent(api);
    },

    subHubNotExsits: function(api){
        var data = add_hub.subHubs;
        var passed = true;
        $.each(data, function(key, value){
            if(api == add_hub.subHubs[key]["api_key"])
                passed = false;
        });

        return passed;
    },

    subHubJSON: function(){
        // return JSON.stringify(add_hub.subHubs);
    },

    updateModuleDropDown: function(){
        var data = add_hub.subHubs;
        $('#sub_hubs').empty().append('<option value="">Please Select</option>');
        $.each(data, function(key, value){
            $('#sub_hubs').append($('<option>', {
                value: data[key]["api_key"],
                text: data[key]["name"]
            }));
        });
    },

    deleteModulesWithNoParent: function(api){
        var data = add_hub.modules;
        add_hub.modules = data.filter(function (find) {
            if(find.sub_hub == api){ $("#"+find.name).remove();}
            return find.sub_hub !== api;
        });
    },

    addModule: function(){
        $( "#add-module" ).click(function() {
            // Validate fields (@todo improve validation later - Sam Mottley)
            if (
                ($("input[name=module_name]").val().length > 0) &&
                ($("input[name=module_interval]").val().length > 0)
            ) {
                // Ensure module name  not already added
                if (add_hub.moduleCheckNameUnique($("input[name=module_name]").val())){
                    $("#module-val-failed").hide();
                    $("#sub-hub-modules").append(add_hub.moduleCreatePanel());
                    add_hub.modulesAddToVar();
                    add_hub.moduleClearFields();
                }else{
                    $("#module-val-failed").show();
                }

            }else{
                $("#module-val-failed").show();
            }
        });
        add_hub.moduleDelete();
    },

    moduleClearFields: function(){
        $("input[name=module_name]").val("");
        $("input[name=module_interval]").val("");
    },

    moduleCreatePanel: function(){
        return "<div class='x_panel' id='"+$("input[name=module_name]").val()+"'> <div class='x_title'><h2>Module ("+$("input[name=module_name]").val()+"...)</h2><ul class='nav navbar-right panel_toolbox' style='min-width: 25px;'><li><a class='show-content'><i class='fa fa-chevron-up'></i></a></li><li><a class='delete-sub-hub'><i class='fa fa-close'></i></a></li></ul><div class='clearfix'></div></div><div class='x_content' style='display: none;'>" +
                "Modules: "+$("select[name=modules] option:selected").text()+"<br/>Sub Hubs: "+$("select[name=sub_hubs] option:selected").text()+"<br/>Module Interval: "+$("input[name=module_interval]").val()+"<br/></div></div>";
    },

    moduleDelete: function(){
        $( document  ).on('click', '.delete-sub-hub', function() {
            var name = $( this ).parents().eq(3).attr("id");
            $("#"+name).remove();
            add_hub.modulesDeleteFromVar(name);
        });
    },

    modulesAddToVar: function(){
        var modules = {}
        modules["name"] = $("input[name=module_name]").val();
        modules["sub_hub"] = $( "select[name=sub_hubs]" ).val();
        modules["module"] = $( "select[name=modules]" ).val();
        modules["interval"] = $("input[name=module_interval]").val();

        add_hub.modules.push(modules);
    },

    modulesDeleteFromVar: function(name){
        var data = add_hub.modules;
        add_hub.modules = data.filter(function (find) {
            return find.name !== name;
        });
    },

    moduleCheckNameUnique: function(name){
        var data = add_hub.modules;
        var passed = true;
        $.each(data, function(key, value){
            if(name == add_hub.modules[key]["name"])
                passed = false;
        });

        return passed;
    }
}

$(document).ready(function () {
    add_hub.init();
});