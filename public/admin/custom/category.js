$(document).ready(function () {
    var gridId = "list_records";
    var grid = $('#' + gridId);
    if (grid.length) {
        grid.jqGrid({
            url: url,
            datatype: "json",
            mtype: "GET",
            onSelectAll: function (aRowids, status) {
                console.log(aRowids, status);
            },
            colNames: ["SNo.", "Title", "Sub Title", "Created At", "Status", "Edit", "Delete"],
            colModel: [
                {name: "sno", width: '5%', align: "center"},
                {name: "title", width: '25%'},
                {name: "subtitle", width: '25%'},
                {name: "created_at", width: '15%'},
                {name: "status", width: '7%'},
                {name: "edit", width: '5%'},
                {name: "delete", width: '5%'}
            ],
            rowNum: 20,
            rowList: [10, 20, 30],
            pager: '#grid-pager',
            sortname: 'created_at',
            viewrecords: true,
            sortorder: "desc",
            //caption: "Post Listing",
            height: '325px',
            shrinkToFit: true,
            //multiselect: true,
            autowidth: true,
            hidegrid: false,
            gridview: true
//        autowidth: true,
//        pager: "#grid-pager",
//        pgbuttons: true,
//        pgtext: true,
//        pginput: false,
//        sortname: "created_at",
//        viewrecords: true,
//        multiselect: true,
//        sortorder: "desc",
//        //caption : "Post List",
//        hidegrid: false,
//        rowNum: 10,
//        rowList: [10, 20, 50, 100],
//        height: 'auto',
//        gridview: true
        });
//$("#list2").jqGrid('navGrid', '#grid-pager', {edit: false, add: false, del: false});
//jQuery("#list_records").jqGrid('navGrid','#grid-pager',{add:false,edit:false,del:false});
        $('#gview_' + gridId).on('click', '.delete', function (event) {
            event.preventDefault();
            if (confirm('Are you sure, You Want to delete this?')) {
                var remove_id = $(this).attr('data-remove');
                document.getElementById(remove_id).submit();
            }
        });
        $("#submitButton").click(function (e) {
            var title = $("#search_title").val();
            var subtitle = $("#search_subtitle").val();
            $('#list_records').jqGrid('setGridParam', {
                url: url + "?title=" + title + "&subtitle=" + subtitle,
                page: 1
            }).trigger("reloadGrid");
        });
        $("#change_publish_status").click(function (e) {
            var ids = grid.getDataIDs();
            var data = {};
            $.each(ids, function (key, id) {
                celValue = ($(grid.jqGrid('getCell', id, 'status')).text().toLowerCase() === 'published') ? 1 : 0;
                data[id] = celValue;
            });
        });
        /*$('#list_records').jqGrid('setGridParam', {
         url: "{{ route('post.data') }}?update_publisher=" + JSON.stringify(data),
         page: 1
         }).trigger("reloadGrid");*/
    }
});