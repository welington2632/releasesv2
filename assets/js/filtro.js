var filter = {
    categories: [],
    tags: []
};

function checkTagFilter(eventHandler) {
    var checked = eventHandler.checked;
    var tagSelect = $(eventHandler).siblings('label').text().toLowerCase();
    if (checked) {
        filter.tags.push(tagSelect);
        console.log('tag adicionada ao filtro : ', tagSelect);
    } else {
        const index = filter.tags.indexOf(tagSelect);
        if (index > -1) {
            filter.tags.splice(index, 1);
        }
    }
    console.log('filter : ', filter);
    hideOrShowElementByFilter();
}

function checkCategoryFilter(eventHandler) {
    var checked = eventHandler.checked;
    var categorySelect = $(eventHandler).siblings('label').text().toLowerCase();

    if (checked) {
        filter.categories.push(categorySelect);
        console.log('adicionado ao filtro : ', categorySelect);
    } else {
        const index = filter.categories.indexOf(categorySelect);
        if (index > -1) {
            filter.categories.splice(index, 1);
        }
    }
    hideOrShowElementByFilter();
}

function getCategoryFiltered(post, categories) {
    if (filter.categories.length <= 0) {
        console.log('caiu no primeiro true categoria');
        return true;
    }

    var havePostInArray = false;
    categories.forEach(element => {
        if ($(post).hasClass('category-' + element)) {
            havePostInArray = true;
        }
    });
    return havePostInArray;
}

function getTagFiltered(post, tags) {
    if (filter.tags.length <= 0) {
        return true;
    }

    var havePostInArray = false;
    tags.forEach(element => {
        if ($(post).hasClass('tag-' + element)) {
            havePostInArray = true;
        }
    });
    return havePostInArray;
}

function hideOrShowElementByFilter() {
    let posts = $('article.post');
    posts.each(function (index, post) {
        if (getTagFiltered(post, filter.tags) && getCategoryFiltered(post, filter.categories)) {
            $(post).parent().show()
        } else {
            $(post).parent().hide()
        }
    });
}

function filterIsNull() {
    if (filter.tags.length <= 0 && filter.categories.length <= 0) {
        return true;
    } else {
        return false;
    }
}