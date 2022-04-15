runSortables();
function runSortables() {
    var sortables = document.querySelectorAll('.menu-list');
    for (var i = 0; i < sortables.length; i++) {
        new Sortable(sortables[i], {
            handle: '.drg-icon',
            group: 'nested',
            animation: 150,
            fallbackOnBody: true,
            swapThreshold: 0.65,
            dataIdAttr: 'data-order'
        });
    }
}

const nestedQuery = '.menu-list';
const sort_root = document.getElementById('menulist');
window.nestedSortableSerialize = (sortable, sortableGroup) => {
    const serialized = [];
    const children = [].slice.call(sortable.children);
    for (let i in children) {
        const nested = children[i].querySelector(sortableGroup)
        const parent = children[i].parentNode.closest('.menu-item');
        var parentId = null;
        if (parent !== null) {
            parentId = parent.getAttribute('data-parent-id');
        } 
        serialized.push({
            item_id: children[i].dataset['order'],
            parent_id: parentId
        });
        if (nested){
            serialized.push(...nestedSortableSerialize(nested, sortableGroup))
        }
    }
    return serialized
}

function addNewItem() {
    var template = document.getElementById("nest-item-template").content;
    var target = document.getElementById("menulist");
    var new_order = $(".menu-item").length + 1;
    target.appendChild(document.importNode(template, true));
    var clone = $("#menulist .menu-item").last();
    clone.attr("data-order", new_order);
    clone.attr("data-parent-id", new_order);
    clone.find(".mt-fl").attr("for", "menuTextInput-" + new_order);
    clone.find(".mu-fl").attr("for", "menuUrlInput-" + new_order);
    clone.find('input[name="menuText-"]').attr("name", "menuText-" + new_order).attr("id", "menuTextInput-" + new_order);
    clone.find('input[name="menuUrl-"]').attr("name", "menuUrl-" + new_order).attr("id", "menuUrlInput-" + new_order);
    runSortables();
}

document.getElementById("menulist").addEventListener('click', e => {
    if(e.target.className == 'rm-item') {
        e.target.closest(".menu-item").remove();
    }
});

$("#upd-form").on("submit", function(event){
    event.preventDefault();
    var menu_order = nestedSortableSerialize(sort_root, nestedQuery);
    $('input[name="menu_order"]').val(JSON.stringify(menu_order));
	$('#upd-form').unbind('submit').submit();
});

function display_alert(alert_text = '', type = 'info', autohide = true, delay = 5000) {
    if (alert_text !== "") {
        const alert_elem = document.querySelector(".alert-toast");
        const toast_options = {
            autohide: autohide,
            delay: delay
        };
        const alert_toast = new bootstrap.Toast(alert_elem, toast_options);
        if (type == 'error') {
            $(".alert-toast").addClass("bg-danger");
        } else if (type == 'success') {
            $(".alert-toast").addClass("bg-success");
        } else {
            $(".alert-toast").addClass("bg-info");
        }
        $(".alert-toast .toast-body").text(alert_text);
        alert_toast.show();
    }    
}