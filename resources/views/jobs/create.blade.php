<x-layout>
    <x-page-heading>New Job</x-page-heading>
    <x-forms.form method="POST" action='/jobs'>
        <x-forms.input label='Title' name='title' placeholder="CEO"/>
        <x-forms.input label='Salary' name='salary' placeholder="$90,000"/>
        <x-forms.input label='Location' name='location' placeholder="Winter Park, Florida"/>

        <x-forms.select label="Schedule" name="schedule">
            <option>Part Time</option>
            <option>Full Time</option>
        </x-forms.select>

        <x-forms.input label='Url' name='url' placeholder="https://acme.com/jobs/ceo-wanted"/>
        <x-forms.checkbox label="Featured (Costs Extra)" name="featured"/>

        <x-forms.divider/>

        <x-forms.input label='Tags(comma seperated)' name='tags' placeholder="Front-End, Backend, PHP"/>
        <x-forms.button class="mt-6">Publish</x-forms.button>
    </x-forms.form>
</x-layout>
