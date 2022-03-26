class Notification{

    succes(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Succesfully Done!',
            timeout: 1000,
        }).show();
    }

    alert(){
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Are you sure ?',
            timeout: 1000,
        }).show();
    }

    error(){
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Something Went Wrong',
            timeout: 1000,
        }).show();
    }

    warning(){
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Oppss Wrong!',
            timeout: 1000,
        }).show();
    }

}

export default Notification = new Notification()