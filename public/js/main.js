function deleteArticle(articleId){
    if (confirm('Are you sure?')) {
        const id = articleId
        fetch(`/article/delete/${id}`, {
            method: 'DELETE'
        }).then(res => window.location.reload())
    }
}

$(() => {

})