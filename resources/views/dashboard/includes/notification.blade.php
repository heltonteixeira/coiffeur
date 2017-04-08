<script>
    @if(Session::has('success'))
        $.notify({
            message: "{{ Session::get('success') }}"
            }, {
                type: "bg-green",
                allow_dismiss: true,
                timer: 1000,
                placement: {
                    from: "top",
                    align: "right"
                },
                animate: {
                    enter: "animated fadeInRight",
                    exit: "animated fadeOutRight"
                },
                template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} p-r-35" role="alert" style="min-width: 300px">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
            });
    @endif

    @if(Session::has('info'))
        $.notify({
            message: "{{ Session::get('info') }}"
            }, {
                type: "bg-blue",
                allow_dismiss: true,
                timer: 1000,
                placement: {
                    from: "top",
                    align: "right"
                },
                animate: {
                    enter: "animated fadeInRight",
                    exit: "animated fadeOutRight"
                },
                template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} p-r-35" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
            });
    @endif

    @if(Session::has('error'))
        $.notify({
            message: "{{ Session::get('error') }}"
            }, {
                type: "bg-blue-grey",
                allow_dismiss: true,
                timer: 1000,
                placement: {
                    from: "top",
                    align: "right"
                },
                animate: {
                    enter: "animated fadeInRight",
                    exit: "animated fadeOutRight"
                },
                template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} p-r-35" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
            });
    @endif
</script>