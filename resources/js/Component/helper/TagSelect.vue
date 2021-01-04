<template>
    <multiselect
        v-model="selectedValues"
        tag-placeholder="Add this as new tag"
        placeholder="Search or add a tag"
        class="rounded-md shadow-sm mt-1 block w-full"
        :id="id"
        label="name"
        track-by="id"
        :options="options"
        :multiple="true"
        :taggable="true"
        @tag="addTag"
        @close="storeUnsavedTag"
        @change="value"
    ></multiselect>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
    props:{
        options:{
            type: Array,
            required: true,
        },
        value:{
            type: Array,
            required: false
        },
        id: {
            type: String,
            default:'tags',
        }
    },
    name: "TagSelect",
    components: {
        Multiselect,
    },
    data(){
        return{
            newTags:[],
        }
    },
    methods: {
        addTag (newTag) {
            const tag = {
                name: newTag,
                id: null,
            }
            this.newTags.push(tag);
            this.options.push(tag);
            this.selectedValues.push(tag);
        },
        storeUnsavedTag(){
            let tags = this.newTags.map(e=>e.name);
            axios.post(route('admin.axios.tags.store'), tags)
            .then(response=>{
                console.log(response);
                if (response.status === 200){
                    if (response.data.data){
                        this.updateValuesItemIds(response.data.data);
                    }

                }else{
                    this.removeNewTagsItems();
                }
            })
            .catch(error=>{
                console.log(error);
                this.removeNewTagsItems();
            }).finally(()=>{
                this.newTags = [];
                //this.updateReturnValue();
            })
        },
        removeNewTagsItems(){
            if (this.newTags.length > 0){
                this.newTags.every((val, key)=>{
                    let index = this.selectedValues.findIndex(v => v.name === val.name);
                    if (index > -1){
                        this.selectedValues.splice(index, 1);
                    }
                })
            }
        },
        updateValuesItemIds(newlyAddedTags){
            if (newlyAddedTags.length > 0){
                newlyAddedTags.map(tag=>{
                    let index = this.selectedValues.findIndex(v => v.name === tag.name);
                    if (index > -1){
                        this.selectedValues[index].id = tag.id;
                    }
                })
            }
        },

    },
    computed:{
        selectedValues: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit('input', val);
            }
        }
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>

</style>
