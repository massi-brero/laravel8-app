confirmDelete = (what, name, model, id) => {
    const question = `Bist du sicher, dass du ${what} \n${name} \nlöschen möchtest?`

    if(confirm(question)) {
        const formAction = `/${model}/${id}`
        $('#form-delete-entry').attr('action', formAction).submit()
    }
}
