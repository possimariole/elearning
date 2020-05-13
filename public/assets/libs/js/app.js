var $collectionHolder;

var $addNewDiplome = $("<a href='#' type='button' class='btn btn-xs btn-primary'>Ajouter un diplome</a>");

var $newTdCell = $('#add').append($addNewDiplome);

jQuery(document).ready(function() {
    // Get the tr that holds the collection of diplomes
    $collectionHolder = $('tbody.diplomes');

    // Add the "add diplome" anchor and td in the diplome tr
    $collectionHolder.append($newTdCell);

    // count the current form input we have (e.g: 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find('tr').length);

    $addNewDiplome.on('click', function(e) {
        // add a new tag form (see next code block)
        addDiplomeForm($collectionHolder, $newTdCell);
    });

    // add a delete link to all of the existing tag form li elements
    $collectionHolder.find('tr').each(function() {
        addDiplomeFormDeleteLink($(this));
    });
});

function addDiplomeForm($collectionHolder, $newTdCell) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // Get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your diplome field in DiplomeType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an td, before the Add diplome button
    var $newFormRow = $('<tr></tr>').append(newForm);
    $newTdCell.before($newFormRow);

    // add a delete link to the new form
    addDiplomeFormDeleteLink($newFormRow);
}

function addDiplomeFormDeleteLink($newFormRow) {
    var $removeFormButton = $('<td><button type="button" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></button></td>');
    $newFormRow.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the li for the tag form
        $newFormRow.remove();
    });
}