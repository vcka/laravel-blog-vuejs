$(document).ready(function () {
    if (gridOptions.grid.length) {
        gridOptions.grid.jqGrid({
            url: gridOptions.url,
            datatype: "json",
            mtype: "GET",
            onSelectAll: function (aRowids, status) {
                console.log(aRowids, status);
            },
            colNames: gridOptions.colNames,
            colModel: gridOptions.colModel,
            rowNum: 20,
            rowList: [10, 20, 30],
            pager: gridOptions.pager,
            sortname: gridOptions.sortname,
            viewrecords: true,
            sortorder: gridOptions.sortorder,
            //caption: "Post Listing",
            height: gridOptions.height,
            shrinkToFit: true,
            //multiselect: true,
            autowidth: true,
            hidegrid: false,
            gridview: true
        });
        $('#gview_' + gridOptions.gridId).on('click', '.delete', function (event) {
            event.preventDefault();
            if (confirm('Are you sure, You Want to delete this?')) {
                var remove_id = $(this).attr('data-remove');
                document.getElementById(remove_id).submit();
            }
        });
        $("#submitButton").click(function (e) {
            var postData = {
                title: $("#search_title").val(),
                page: 1
            };
            if ($("#search_subtitle").length) {
                postData.subtitle = $("#search_subtitle").val();
            }
            gridOptions.grid.jqGrid('setGridParam', {postData}).trigger("reloadGrid");
        });

        $("#resetButton").click(function (e) {
            $("#search_title").val('');
            var postData = {title: ''};
            if ($("#search_subtitle").length) {
                $("#search_subtitle").val('');
                postData.subtitle = '';
            }
            gridOptions.grid.jqGrid('setGridParam', {postData}).trigger("reloadGrid", [{page: 1}]);
        });


        $("#change_publish_status").click(function (e) {
            var ids = gridOptions.grid.getDataIDs();
            var data = {};
            $.each(ids, function (key, id) {
                celValue = ($(gridOptions.grid.jqGrid('getCell', id, 'status')).text().toLowerCase() === 'published') ? 1 : 0;
                data[id] = celValue;
            });
        });
        
        $(document).on('change', ".checkbox_approved", function (e) {            
            var id = $(this).attr('data-id');
            /*var data = {};
            $.each(ids, function (key, id) {
                celValue = ($(gridOptions.grid.jqGrid('getCell', id, 'status')).text().toLowerCase() === 'published') ? 1 : 0;
                data[id] = celValue;
            });*/
        });
    }
});