  <div class="container-lg my-5">
        <h3>Note App</h3>
        <div class="d-flex my-5">
            <button class="btn btn-dark btn-create">Create note</button>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="noteTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modalCreateNote">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><span id="note-title"></span> Note</h3>
                </div>
                <div class="modal-body">
                    <form id="noteForm">
                        <div class="form-group d-block mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control"/>
                        </div>
                        <div class="form-group d-block mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" id="description" class="form-control"/>
                        </div>
                        <div class="form-group d-block mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" name="type" id="type" class="form-control"/>
                        </div>
                        <div class="status-block"></div>
                        <div class="mt-5 d-flex justify-content-end align-items-center gap-2">
                            <button class="btn btn-secondary btn-cancel" type="button">Cancel</button>
                            <button class="btn btn-dark" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(function () {
    $(document).on("click", ".btn-cancel", function () {
        $("#modalCreateNote").modal("hide");
    })

    $(".btn-create").click(function () {
        $(".status-block").html("");
        $("#note-title").text("Create");
        $("#noteForm button[type='submit']").text("Create");
        $("#noteForm button[type='submit']").removeAttr("data-id");
        $("input[name='title']").val("");
        $("input[name='description']").val("");
        $("input[name='type']").val("");
        $("#modalCreateNote").modal("show");
    })

    function listAllNotes(data) {
        const renderData = $.map(data, function (item) {
            return `
                <tr>
                    <td>${item.note_id}</td>
                    <td>${item.title}</td>
                    <td>${item.description}</td>
                    <td>${item.type}</td>
                    <td>${item.status}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-warning btn-sm btn-edit" data-id='${item.note_id}'>Edit</button>
                            <button class="btn btn-danger btn-sm btn-delete" data-id='${item.note_id}'>Delete</button>
                        </div>
                    </td>
                </tr>
            `
        })

        $("#noteTable tbody").html(renderData.join(""));
    }

    $("#noteForm").off("submit").on("submit", function (e) {
        e.preventDefault();
        var note_id = $("#noteForm button[type='submit']").attr("data-id");
        var title = $("input[name='title']").val();
        var description = $("input[name='description']").val();
        var type = $("input[name='type']").val();
        var status = $("select[name='status']").val();
        var payload = note_id ? { note_id, title, description, type, status } : { title, description, type };

        $.ajax({
            type: "POST",
            url: "./controllers/noteController.php",
            data: {
                method: note_id ? "EDI" : "INS",
                ...payload
            },
            success: function (response) {
                const res = JSON.parse(response);
                if (res.status === 200) {
                    alert(`${note_id ? "Edited" : "Created"} successfully`);
                    $("#modalCreateNote").modal("hide");
                    listAllNotes(res.data);
                }
            },
            error: function () {
                console.log("Something error!");
            }
        })
    })

    $(document).on("click", ".btn-edit", function () {
        $("#note-title").text("Edit");
        $("#noteForm button[type='submit']").text("Edit");
        var id = $(this).attr("data-id");
        $("#noteForm button[type='submit']").attr("data-id", id);

        $.ajax({
            type: "POST",
            url: "./controllers/noteController.php",
            data: {
                method: "GET_ID",
                note_id: id
            },
            success: function (response) {
                const res = JSON.parse(response);
                if (res.status === 200) {
                    $(".status-block").html(`
                        <div class="form-group d-block mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    `);
                    $("input[name='title']").val(res.data.title);
                    $("input[name='description']").val(res.data.description);
                    $("input[name='type']").val(res.data.type);
                    $("select[name='status']").val(res.data.status);
                    $("#modalCreateNote").modal("show");
                }
            },
            error: function () {
                console.log("Something error!");
            }
        })
    })

    $(document).on("click", ".btn-delete", function () {
        var id = $(this).attr("data-id");
        var confirmation = confirm("Are you sure to delete this note?");
        if (confirmation) {
            $.ajax({
                type: "POST",
                url: "./controllers/noteController.php",
                data: {
                    method: "DEL",
                    note_id: id
                },
                success: function (response) {
                    const res = JSON.parse(response);
                    if (res.status === 200) {
                        alert("Deleted successfully");
                        listAllNotes(res.data);
                    }
                },
                error: function () {
                    console.log("Something error!");
                }
            })
        }
    })

    $.ajax({
        type: "POST",
        url: "./controllers/noteController.php",
        data: {
            method: "GET"
        },
        success: function (response) {
            const res = JSON.parse(response);
            if (res.status === 200) {
                listAllNotes(res.data);
            }
        },
        error: function (err) {
            console.log("Something error! " + JSON.stringify(err));
        }
    })
})
    </script>