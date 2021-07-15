let resources = [
    {
        name:'item',
        parent:'',
        discreption:'items resource'
    },
    {
        name:'type',
        parent:'',
        discreption:'types resource'
    },
    {
        name:'category',
        parent:'',
        discreption:'categories resource'
    },
    {
        name:'customer',
        parent:'',
        discreption:'customers resource'
    },
    {
        name:'gardner',
        parent:'',
        discreption:'gardners resource'
    },
    {
        name:'order',
        parent:'customer',
        discreption:'orders resource'
    },
    {
        name:'order',
        parent:'',
        discreption:'orders resource'
    },
    {
        name:'purchase',
        parent:'order',
        module_name:'order_purchase',
        discreption:'purchases resource'
    },
    {
        name:'payment',
        parent:'order',
        module_name:'order_payment',
        discreption:'payments resource'
    },
    {
        name:'item',
        parent:'',
        discreption:'items resource'
    },
    {
        name:'accessor',
        parent:'',
        discreption:'items accessors resource'
    },
    {
        name:'gallery',
        parent:'',
        discreption:'gallery resource'
    },
    {
        name:'media',
        parent:'gallery',
        discreption:'gallery media resource'
    },
    {
        name:'tax',
        parent:'',
        discreption:'tax resource'
    },
    {
        name:'task',
        parent:'purchase',
        discreption:'task resource'
    },
    {
        // `${resource.parent?'/'+resource.parent+'/'+parent_id:''}/${resource.name}`, post_data);
        // task/task/
        name:'confirmation',
        parent:'task',
        discreption:'task confirmation resource'
    },
    {
        name:'home',
        parent:'',
        discreption:'home data resource'
    },
    {
        name:'post',
        parent:'',
        discreption:'posts resource'
    },
    {
        name:'reaction',
        parent:'item',
        discreption:'item reaction resource'
    },
    {
        name:'tag',
        parent:'item',
        module_name:'item_tags',
        
        discreption:'item reaction resource'
    },
    {
        name:'setting',
        parent:'',        
        discreption:'settings resource'
    },
    {
        name:'city',
        parent:'',        
        discreption:'cities resource'
    },
    {
        name:'country',
        parent:'',        
        discreption:'countries resource'
    },
    {
        name:'friend',
        parent:'',        
        discreption:'friends resource'
    },
    {
        name:'cover',
        parent:'gallery',        
        discreption:'friends resource'
    },

    {
        name:'tag',
        parent:'',        
        discreption:'friends resource'
    },
    {
        name:'rank',
        parent:'item',        
        discreption:'friends resource'
    },
] 
export default resources;