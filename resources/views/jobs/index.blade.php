<x-home.layout>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">Let's Find Your Next Job</h1>
            <x-forms.form action='/search' class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="Web Developer..." />
            </x-forms.form>
        </section>
        <section class="pt-10">
            <x-home.section-heading>Featured Jobs</x-home.section-heading>
            <div class="grid xl:grid-cols-3 gap-8 mt-6">
{{--                @foreach ($featuredJobs as $job)--}}
{{--                    <x-home.job-card :$job />--}}
{{--                @endforeach--}}
            </div>
        </section>

        <section>
            <x-home.section-heading>Tags</x-home.section-heading>
            <div class="mt-6 space-x-1 flex justify-center flex-wrap">
                @foreach ($tags as $tag)
                    <x-home.tag :$tag />
                @endforeach

            </div>
        </section>
        <section>
            <x-home.section-heading>Recent Jobs</x-home.section-heading>
            <div class="mt-6 space-y-6">
                @foreach ($jobs as $job)
                    <x-home.job-card-wide :$job />
                @endforeach
{{--                <x-home.panel>Hello there</x-home.panel>--}}
            </div>
        </section>
    </div>
</x-home.layout>
