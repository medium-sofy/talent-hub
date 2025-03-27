<x-home.layout>
    <x-home.page-heading>New Job</x-home.page-heading>
    <x-forms.form method="POST" action='/jobs'>
        <x-forms.input label='Title' name='title' placeholder="CEO"/>
        <x-forms.input label='Description' name='description' placeholder="Manage executive tasks"/>
        <x-forms.input label='Requirements' name='requirements' placeholder="Job prerequisites"/>
        <x-forms.input label='Benefits' name='benefits' placeholder="CEO"/>

        <x-forms.input label='Location' name='location' placeholder="Winter Park, Florida"/>
        <x-forms.select label="Workplace type" name="workplace">
            <option>Remote</option>
            <option>On-Site</option>
            <option>Hybrid</option>
        </x-forms.select>
        <x-forms.input label='Lower salary range' name='lower_salary' placeholder="15,000 EGP"/>
        <x-forms.input label='Upper salary range' name='upper_salary' placeholder="10,000 EGP"/>
        <x-forms.select label="Category" name="category_id">
            <option value="" selected>Choose a category</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </x-forms.select>
        <x-forms.input type="date" label='Deadline' name='application_deadline' />

        <x-forms.select label="Schedule" name="job_type">
            <option>Part Time</option>
            <option>Full Time</option>
            <option>Freelance</option>
        </x-forms.select>
        <x-forms.divider/>
{{--        <x-forms.input label='Tags(comma seperated)' name='tags' placeholder="Front-End, Backend, PHP"/>--}}
        <x-forms.button class="mt-6">Publish</x-forms.button>
    </x-forms.form>
</x-home.layout>
