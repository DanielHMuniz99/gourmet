$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function next(id)
{
    $.ajax({
        method: "POST",
        url: "/next/" + id,
        dataType : 'html'
    }).done(function(data) {
        $(".form-card").html(data)
    });
}

function child(id)
{
    $.ajax({
        method: "POST",
        url: "/child/" + id,
        dataType : 'html'
    }).done(function(data) {
        $(".form-card").html(data)
    });
}

function start()
{
    $.ajax({
        method: "POST",
        url: "/start",
        dataType : 'html',
    }).done(function(data) {
        $(".form-card").html(data)
    });
}

function store(parentId = "", childId = "")
{
    $.ajax({
        method: "POST",
        url: "/store",
        dataType : 'json',
        data: {"parent_id": parentId, "name": $("#name").val()}
    }).done(function(data) {
        if (childId) {
            return update(childId, data.id)
        }
        load(data.id, parentId);
    });
}

function update(id = "", parent_id = 0)
{
    $.ajax({
        method: "PUT",
        url: "/update/" + id,
        dataType : 'json',
        data: {"parent_id": parent_id}
    }).done(function(data) {
        location.reload()
    });
}

function load(id = 0)
{
    $.ajax({
        method: "GET",
        url: "/load/" + id,
        dataType : 'html'
    }).done(function(data) {
        $(".form-card").html(data)
    });
}
