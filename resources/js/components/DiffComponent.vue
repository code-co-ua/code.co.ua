<template>
    <pre v-html="span" class="w-100"></pre>
</template>

<script>
    export default {
        data() {
            return {
                classes: '',
                span: '',
            }
        },
        props: ['one', 'other'],
        mounted() {
            self = this;
            var diff = jsdiff.diffChars(this.one, this.other);

            diff.forEach(function (part) {
                // green for additions, red for deletions
                // grey for common parts
                self.classes = part.added ? 'text-success' : part.removed ? 'text-danger cm-strikethrough' : ''/*'text-gray'*/;
                self.span += "<span class='" + self.classes + "'>" + part.value + "</span>";
            });
        }
    }
</script>
