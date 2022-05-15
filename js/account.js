function editMode()
{
    
    for(element of document.getElementsByClassName('display'))
    {
        element.classList.add('hide');
    }
    for(element of document.getElementsByClassName('edit'))
    {
        element.classList.remove('hide');
    }
}

function photoSelected()
{
    let photoSelecter = document.getElementById('photo-input');
    let image = document.getElementById('profile-img');

    if (photoSelecter.files.length < 1)
    {
        document.getElementById('photo-input').disabled = true;
        image.src = originalImage;
        return;
    }

    image.src = URL.createObjectURL(photoSelecter.files[0]);
}

function chooseFile()
{
    document.getElementById('photo-input').disabled = false;
    document.getElementById('photo-input').click();

}

function removeProfilePicture()
{
    document.getElementById('photo-input').disabled = false;
    document.getElementById('profile-img').src = 'images/profile/default.png';
}