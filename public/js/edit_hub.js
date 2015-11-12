/**
 * This class controls the editing / configuration of hubs
 *
 * @author Sam Mottley
 */

var edit_hub = {

    subHubs: [],

    modules: [],

    init: function(){
        // Update hardware
        edit_hub.loadConfiguration();

        // Check for adding of sub hub
        this.addSubHub();

        // Check for adding modules
        this.addModule();

        // Show desc when user wants
        edit_hub.openDesc();

        // Update hardware
        edit_hub.updateHardware();
    },

    loadConfiguration: function(){
        // Get and assign relevant data
        var config = JSON.parse($("input[id=hardware_config]").val());
        var modules = JSON.parse($("input[id=module_list]").val());
        edit_hub.subHubs = config['sub_hubs'];
        edit_hub.modules = config['modules'];

        // Create sub hub panels
        $.each(config['sub_hubs'], function(key, value){
            $("#sub-hubs").append(edit_hub.subHubCreatePanel(value['api_key'], value['name'], value['api_user'], value['api_enc']));
        });

        // Create module panels
        var moduleName = '';
        var subHubName = '';
        $.each(config['modules'], function(key, value){
            moduleName = modules.filter(function (find) {
                if(find.id == value['module'])
                    return find.setting;
            });
            moduleName = moduleName[0]['setting'];

            subHubName = config['sub_hubs'].filter(function (find) {
                if(find.api_key == value['sub_hub'])
                    return find.api_key;
            });
            subHubName = subHubName[0]['name'];

            $("#sub-hub-modules").append(edit_hub.moduleCreatePanel(value['name'], moduleName, subHubName, value['interval'],value['module_connections'], value['sub_hub']));
        });

        // Update module drop down box
        edit_hub.updateModuleDropDown();
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
                if(edit_hub.subHubNotExsits($("input[name=sub_api_key]").val()) != false){
                    $("#sub-hub-val-failed").hide();
                    $("#sub-hubs").append( edit_hub.subHubCreatePanel() );
                    edit_hub.subHubAddToVar();
                    edit_hub.subHubClearFields();
                }else{
                    $("#sub-hub-val-failed").show();
                }
            }else{
                $("#sub-hub-val-failed").show();
            }
        });
        edit_hub.subHubDelete();
    },

    subHubCreatePanel: function(key, subHub, user, enc){
        key = key || $("input[name=sub_api_key]").val();
        subHub = subHub || $("input[name=sub_name]").val();
        user = user || $("input[name=sub_api_user]").val();
        enc = enc || $("input[name=sub_api_enc]").val();

        return  "<div class='x_panel' id='"+key+"'> <div class='x_title'><h2>Sub Hub ("+subHub+"...)</h2>" +
                "<ul class='nav navbar-right panel_toolbox' style='min-width: 25px;'><li><a class='show-content'>" +
                "<i class='fa fa-chevron-up'></i></a></li><li><a class='delete-sub-hub'><i class='fa fa-close'></i></a>" +
                "</li></ul><div class='clearfix'></div></div>" +
                "<div class='x_content' style='display: none;'>API Key: "+key+"<br/>" +
                "API Enc: "+enc+"<br/>" +
                "API User: "+user+"<br/></div></div>";
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
            edit_hub.subHubDeleteFromVar(api);
        });
    },

    subHubAddToVar: function(){
        var subHub = {};
        subHub["name"] = $("input[name=sub_name]").val();
        subHub["api_key"] = $("input[name=sub_api_key]").val();
        subHub["api_enc"] = $("input[name=sub_api_enc]").val();
        subHub["api_user"] = $("input[name=sub_api_user]").val();
        subHub["api_pass"] = $("input[name=sub_api_pass]").val();

        edit_hub.subHubs.push(subHub);

        edit_hub.updateModuleDropDown();
    },

    subHubDeleteFromVar: function(api){
        var data = edit_hub.subHubs;
        edit_hub.subHubs = data.filter(function (find) {
            return find.api_key !== api;
        });
        edit_hub.updateModuleDropDown();
        edit_hub.deleteModulesWithNoParent(api);
    },

    subHubNotExsits: function(api){
        var data = edit_hub.subHubs;
        var passed = true;
        $.each(data, function(key, value){
            if(api == edit_hub.subHubs[key]["api_key"])
                passed = false;
        });

        return passed;
    },

    updateModuleDropDown: function(){
        var data = edit_hub.subHubs;
        $('#sub_hubs').empty().append('<option value="">Please Select</option>');
        $.each(data, function(key, value){
            $('#sub_hubs').append($('<option>', {
                value: data[key]["api_key"],
                text: data[key]["name"]
            }));
        });
    },

    deleteModulesWithNoParent: function(api){
        var data = edit_hub.modules;
        edit_hub.modules = data.filter(function (find) {
            if(find.sub_hub == api){ $("."+find.sub_hub).remove();}
            return find.sub_hub !== api;
        });
    },

    addModule: function(){
        $( "#add-module" ).click(function() {
            // Validate fields (@todo improve validation later - Sam Mottley)
            if (
                ($("input[name=module_name]").val().length > 0) &&
                ($("input[name=module_connections]").val().length > 0) &&
                ($("input[name=module_interval]").val().length > 0)
            ) {
                // Ensure module name  not already added
                if (edit_hub.moduleCheckNameUnique($("select[name=sub_hubs]").val()+$("input[name=module_connections]").val())){
                    $("#module-val-failed").hide();
                    $("#sub-hub-modules").append(edit_hub.moduleCreatePanel());
                    edit_hub.modulesAddToVar();
                    edit_hub.moduleClearFields();
                }else{
                    $("#module-val-failed").show();
                }

            }else{
                $("#module-val-failed").show();
            }
        });
        edit_hub.moduleDelete();
    },

    moduleClearFields: function(){
        $("input[name=module_name]").val("");
        $("input[name=module_interval]").val("");
        $("input[name=module_connections]").val("");
    },

    moduleCreatePanel: function(name, modules, subHub, interval, connect, subhubapi){
        subhubapi = subhubapi ||$("select[name=sub_hubs] option:selected").val();
        var id = subhubapi+connect || $("select[name=sub_hubs] option:selected").val()+$("input[name=module_connections]").val()

        name = name || $("input[name=module_name]").val();
        modules = modules || $("select[name=modules] option:selected").text();
        subHub = subHub || $("select[name=sub_hubs] option:selected").text();
        interval = interval || $("input[name=module_interval]").val();
        connect = connect || $("input[name=module_connections]").val();

        return "<div class='x_panel "+subhubapi+"' id='"+id+"'> <div class='x_title'><h2>Module ("+name+"...)</h2><ul class='nav navbar-right panel_toolbox' style='min-width: 25px;'><li><a class='show-content'><i class='fa fa-chevron-up'></i></a></li><li><a class='delete-sub-hub'><i class='fa fa-close'></i></a></li></ul><div class='clearfix'></div></div><div class='x_content' style='display: none;'>" +
                "Module Connections:"+connect+"<br/>Modules: "+modules+"<br/>Sub Hubs: "+subHub+"<br/>Module Interval: "+interval+"<br/></div></div>";
    },

    moduleDelete: function(){
        $( document  ).on('click', '.delete-sub-hub', function() {
            var name = $( this ).parents().eq(3).attr("id");
            $("#"+name).remove();
            edit_hub.modulesDeleteFromVar(name);
        });
    },

    modulesAddToVar: function(){
        var module = {};
        module["name"] = $("input[name=module_name]").val();
        module["sub_hub"] = $( "select[name=sub_hubs]" ).val();
        module["module"] = $( "select[name=modules]" ).val();
        module["interval"] = $("input[name=module_interval]").val();
        module["module_connections"] = $("input[name=module_connections]").val();

        edit_hub.modules.push(module);
    },

    modulesDeleteFromVar: function(name){
        var data = edit_hub.modules;
        edit_hub.modules = data.filter(function (find) {
            return find.name !== name;
        });
    },

    moduleCheckNameUnique: function(name){
        var data = edit_hub.modules;
        var passed = true;
        $.each(data, function(key, value){
            if(name == edit_hub.modules[key]["sub_hub"]+edit_hub.modules[key]["module_connections"])
                passed = false;
        });

        return passed;
    },

    updateHardware: function(){
        $( "#update_hardware" ).on( "click", function() {
            // update_hardware
            if(edit_hub.validate()){
                var data = {
                    sub_hubs: edit_hub.subHubs,
                    modules: edit_hub.modules,
                    _method: 'PUT',
                    _token: $("input[name=_token]").val()
                };

                // @todo improve reporting of errors - Sam Mottley
                var post = $.post( "./hardware", data, function() {
                }).done(function(returned) {
                    if($.isNumeric(returned)){
                        window.location.replace("../"+returned+"/edit");
                    }else{
                        alert( "There seems to be a technical error, please refresh your page and try again." );
                        $("input[name=_token]").val(returned);
                    }
                }).fail(function() {
                    alert( "There seems to be a technical error, please refresh your page and try again." );
                });
            }
        });
    },

    validate: function(){
        // @todo improve validation - Sam Mottley
        if($.isEmptyObject(this.subHubs)){
            $("#sub-module-failed").show();
            return false
        }
        $("#sub-module-failed").hide();
        return true;
    },

}

$(document).ready(function () {

    // Init control JS
    edit_hub.init();

});