const state = {
    items: [],
    counter: 0
};
const getters = {
    all: state => state.posts
};
const actions = {
    addItem({
        commit,
        state
    }, item) {
        let ex_item = state.items.find((i) => i.id == item.id);
        if (ex_item == undefined) {
            item.quantity = item.qty || 1;
            item.editable = true;
            item.locationable = true;
            item.location = {
                type: 'private'
            };
            commit('add_item', item);
        } else {
            commit('increment_item', ex_item);
        }
    },
    addAccessor({
        commit,
        state
    }, item) {
        let ex_item = state.items.find((i) => i.id == item.accessor_item_id && !i.editable);
        if (ex_item == undefined) {
            let c_item = {};
            c_item = item.accessor;
            c_item.quantity = item.qty;
            c_item.editable = false;
            // console.log(item);
            c_item.locationable = false;

            c_item.description = 'accessor';
            console.log(c_item);
            console.log(item);
            commit('add_item', c_item);
        } else {
            commit('increment_item', ex_item);
        }
    },
    removeItem({
        commit
    }, item) {
        if (item.accessors) {
            item.accessors.map(i => {
                commit('remove_item', i.accessor);
            })
        }
        commit('remove_item', item)
    },
    updateQuantity({
        commit
    }, item) {
        if (item.accessors) {
            item.accessors.map(i => {
                i.accessor.quantity = i.qty * item.quantity;
                commit('update_quantity', i.accessor);
            })
        }
        commit('update_quantity', item);
    }
}
const mutations = {
    add_item: (state, item) => {
        state.items.push(item)
        state.counter += item.quantity;
    },
    increment_item: (state, item) => {
        let item_s = state.items.find(i => i.id == item.id)
        item_s.quantity++;
        state.counter ++;
    },
    update_quantity: (state, item) => {
        state.items.find(i => i.id == item.id).quantity = item.quantity;
        state.counter += item.quantity;
    },
    remove_item: (state, item) => {

        let index = state.items.findIndex(x => x.id == item.id);
        state.counter -= item.quantity;
        if (index > -1)
            state.items.splice(index, 1)
    },

}
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}