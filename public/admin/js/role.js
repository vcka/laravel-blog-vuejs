$(document).ready(function () {
        $(".all_checkbox").click(function () {
            $('.parent_checkbox:checkbox').not(this).prop('checked', this.checked);
            $('.child_checkbox:checkbox').not(this).prop('checked', this.checked);
        });
        $(".parent_checkbox").click(function () {
            var parentId = $(this).data('id');
            $('.child_checkbox_' + parentId + ':checkbox').not(this).prop('checked', this.checked);
        });

        $(".child_checkbox").click(function () {
            var parentId = $(this).data('parent-id');
            var checkedCheckBoxes = $('.child_checkbox_' + parentId + ':checked').length;
            if (checkedCheckBoxes <= 0) {
                $('.parent_checkbox_' + parentId).prop('checked', false);
            } else {
                $('.parent_checkbox_' + parentId).prop('checked', true);
            }
        });


        /*=========================================*/
        $("#vertical-menu h3").click(function (e) {
            var target = e.target || e.srcElement;            
            if ($(target).attr('type') !== 'checkbox') {
                //slide up all the link lists
                $("#vertical-menu ul ul").slideUp();
                $('.plus', this).html('+');
                //slide down the link list below the h3 clicked - only if its closed
                if (!$(this).next().is(":visible")) {
                    $(this).next().slideDown();
                    //$(this).remove("span").append('<span class="minus">-</span>');
                    $('.plus').html('+');
                    $('.plus', this).html('-');
                }
            }
        });
        /*=========================================*/
    });