// // /assets/script.js
// $(function () {
//     $(document).on("click", ".btn-cancel", function () {
//         $("#modalCreateNote").modal("hide");
//     });
//
//     $(".btn-create").click(function () {
//         $(".status-block").html("");
//         $("#note-title").text("Create");
//         $("#noteForm button[type='submit']").text("Create").removeAttr("data-id");
//         $("input[name='title'], input[name='description'], input[name='type']").val("");
//         $("#modalCreateNote").modal("show");
//     });
//
//     function listAllNotes(data) {
//         const renderData = $.map(data, item => `
//             <tr>
//                 <td>${item.note_id}</td>
//                 <td>${item.title}</td>
//                 <td>${item.description}</td>
//                 <td>${item.type}</td>
//                 <td>${item.status}</td>
//                 <td>
//                     <div class="d-flex gap-2">
//                         <button class="btn btn-warning btn-sm btn-edit" data-id='${item.note_id}'>Edit</button>
//                         <button class="btn btn-danger btn-sm btn-delete" data-id='${item.note_id}'>Delete</button>
//                     </div>
//                 </td>
//             </tr>
//         `);
//         $("#noteTable tbody").html(renderData.join(""));
//     }
//
//     $("#noteForm").on("submit", function (e) {
//         e.preventDefault();
//         const note_id = $("#noteForm button[type='submit']").attr("data-id");
//         const title = $("input[name='title']").val();
//         const description = $("input[name='description']").val();
//         const type = $("input[name='type']").val();
//         const status = $("select[name='status']").val();
//         const payload = note_id ? { note_id, title, description, type, status } : { title, description, type };
//
//         $.post("./controllers/noteController.php", {
//             method: note_id ? "EDI" : "INS",
//             ...payload
//         }, function (response) {
//             const res = JSON.parse(response);
//             if (res.status === 200) {
//                 alert(`${note_id ? "Edited" : "Created"} successfully`);
//                 $("#modalCreateNote").modal("hide");
//                 listAllNotes(res.data);
//             }
//         }).fail(() => console.log("Something error!"));
//     });
//
//     $(document).on("click", ".btn-edit", function () {
//         const id = $(this).data("id");
//         $("#noteForm button[type='submit']").attr("data-id", id).text("Edit");
//         $("#note-title").text("Edit");
//
//         $.post("./controllers/noteController.php", {
//             method: "GET_ID",
//             note_id: id
//         }, function (response) {
//             const res = JSON.parse(response);
//             if (res.status === 200) {
//                 $(".status-block").html(`
//                     <div class="form-group d-block mb-3">
//                         <label for="status" class="form-label">Status</label>
//                         <select name="status" id="status" class="form-select">
//                             <option value="1">Active</option>
//                             <option value="0">Inactive</option>
//                         </select>
//                     </div>
//                 `);
//                 $("input[name='title']").val(res.data.title);
//                 $("input[name='description']").val(res.data.description);
//                 $("input[name='type']").val(res.data.type);
//                 $("select[name='status']").val(res.data.status);
//                 $("#modalCreateNote").modal("show");
//             }
//         });
//     });
//
//     $(document).on("click", ".btn-delete", function () {
//         const id = $(this).data("id");
//         if (confirm("Are you sure to delete this note?")) {
//             $.post("./controllers/noteController.php", {
//                 method: "DEL",
//                 note_id: id
//             }, function (response) {
//                 const res = JSON.parse(response);
//                 if (res.status === 200) {
//                     alert("Deleted successfully");
//                     listAllNotes(res.data);
//                 }
//             });
//         }
//     });
//
//     // Initial fetch
//     $.post("./controllers/noteController.php", {
//         method: "GET"
//     }, function (response) {
//         const res = JSON.parse(response);
//         if (res.status === 200) listAllNotes(res.data);
//     });
// });
// side bar


