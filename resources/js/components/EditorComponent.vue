<template>
    <textarea ref="area" :name="name"></textarea>
</template>

<script>
    import simplemde from 'simplemde'
    import 'simplemde/dist/simplemde.min.css'

    export default {
        props: ['value', 'name'],
        mounted() {
            this.mde = new simplemde({
                element: this.$refs.area,
                promptURLs: true,
                previewRender: function (plainText, preview) {
                    setTimeout(function () {
                        preview.innerHTML = this.parent.markdown(plainText);
                        Prism.highlightAll();
                    }.bind(this), 1)
                    return "Завантаження..."//"Loading..."
                },
                spellChecker: false,
                // Put your extra SimpleMDE settings here.
            })
            this.mde.value(this.value)
            /*
            var self = this
            this.mde.codemirror.on('change', function () {
                self.$emit('input', self.mde.value())
            })*/
        },
        /*watch: {
            value(newVal) {
                if (newVal != this.mde.value()) {
                    this.mde.value(newVal)
                }
            }
        },*/
        beforeDestroy() {
            this.mde.toTextArea() // clean up when component gets destroyed.
        }
    }
</script>
