cooltab = new Object({

    tab: null,
    tabs: null,

    init: function(id) {
        this.tab = document.querySelector(id)
        this.tabs = this.tab.querySelectorAll("details");
        this.tabs.forEach(item => {
            item.querySelector("summary").addEventListener('click', function(e) {
                e.preventDefault()
                cooltab.select(item.dataset.id);

            })
        });

    },

    select: function(num) {
        this.tabs.forEach(item => {
            if (item.dataset.id == num) {
                item.open = true;
            } else {
                item.open = false;
            }
        })
    }

});







