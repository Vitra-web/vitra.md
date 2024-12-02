const storagePath = $.cookie('userPath');
// console.log('storagePath before', storagePath)

if(storagePath) {
    const storagePathParsed = JSON.parse(storagePath);
    if(storagePathParsed[0]['url'] !== window.location.href ) {
        if(storagePathParsed.length >=5) {
            storagePathParsed.pop();
        }

        storagePathParsed.unshift({
            'url': window.location.href
        })
        $.cookie('userPath', JSON.stringify(storagePathParsed), { path: '/' });
    }

} else {
    $.cookie('userPath', JSON.stringify([{
        'url': window.location.href
    }]), {path: '/'});
}

// console.log('storagePath after', storagePath)
