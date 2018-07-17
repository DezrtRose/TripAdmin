function BrowseServer(element) {
    var resourceType = $(element).data('resource-type');
    var selectMultiple = $(element).data('multiple');
    var elementId = $(element).attr('id');

    // You can use the "CKFinder" class to render CKFinder in a page:
    var finder = new CKFinder();

    // Type of the resource
    finder.resourceType = resourceType;

    // Select Multiple
    finder.selectMultiple = selectMultiple;

    // Name of a function which is called when a file is selected in CKFinder.
    finder.selectActionFunction = SetFileFieldSingle;
    if (selectMultiple) {
        finder.selectActionFunction = SetFileFieldMultiple;
    }

    // Additional data to be passed to the selectActionFunction in a second argument.
    // We'll use this feature to pass the Id of a field that will be updated.
    finder.selectActionData = elementId;

    // Launch CKFinder
    finder.popup();
}

function SetFileFieldSingle(fileUrl, data) {
    var name = data["selectActionData"];
    var pieces = fileUrl.split('/');
    //pieces.splice(0, 2);
    fileUrl = pieces.join('/');
    $('#' + data["selectActionData"]).val(fileUrl);
    var base_url = $('#base_url').val();
    $('#' + data["selectActionData"]).after('<div class="new-gallery"><img src="'+ base_url + fileUrl +'" width="60" height="60"/></div>');
}

function SetFileFieldMultiple(fileUrl, data, allFiles) {
    var name = data["selectActionData"];
    var base_url = $('#base_url').val();
    if (allFiles.length > 1) {
        var msg = [];
        for (var i = 0; i < allFiles.length; i++) {
            // See also allFiles[i].url
            var pieces = allFiles[i].data['fileUrl'].split('/');
            pieces.splice(0, 2);
            fileUrl = pieces.join('/');
            msg.push(fileUrl);
            $('#' + data["selectActionData"]).after('<div class="new-image"><img src="'+ base_url + fileUrl +'" width="60" height="60"/></div>');
        }
        //$('#' + data["selectActionData"]).val(msg.join(','));

    } else {
        var pieces = fileUrl.split('/');
        pieces.splice(0, 2);
        fileUrl = pieces.join('/');
        //$('#' + data["selectActionData"]).val(fileUrl);
        $('#' + data["selectActionData"]).after('<div class="new-image"><img src="'+ base_url + fileUrl +'" width="60" height="60"/></div>');
    }
}