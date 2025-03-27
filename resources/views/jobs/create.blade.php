<x-home.layout>
    <x-home.page-heading>New Job</x-home.page-heading>
    <x-forms.form method="POST" action='/jobs'>
        <x-forms.input label='Title' name='title' placeholder="CEO"/>
        <x-forms.input label='Description' name='description' placeholder="CEO"/>
        <x-forms.input label='Requirements' name='requirements' placeholder="CEO"/>
        <x-forms.input label='Benefits' name='benefits' placeholder="CEO"/>

        <x-forms.input label='Location' name='location' placeholder="Winter Park, Florida"/>
        <x-forms.select label="Workplace type" name="workplace">
            <option>Remote</option>
            <option>On-Site</option>
            <option>Hybrid</option>
        </x-forms.select>
        <x-forms.input label='Lower salary range' name='lower_salary' placeholder="$90,000"/>
        <x-forms.input label='Upper salary range' name='upper_salary' placeholder="$90,000"/>
        <x-forms.input label='Category' name='location' placeholder="Winter Park, Florida"/>
        <x-forms.input label='Deadline' name='location' placeholder="Winter Park, Florida"/>

        <x-forms.select label="Schedule" name="job_type">
            <option>Part Time</option>
            <option>Full Time</option>
            <option>Freelance</option>
        </x-forms.select>
{{--
   Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employer_id');
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->text('benefits')->nullable();
            $table->string('location');
            $table->unsignedBigInteger('category_id');
            $table->enum('workplace', ['remote', 'onsite', 'hybrid']);
            $table->enum('job_type', ['Full-time', 'Part-time', 'freelance']);
            $table->unsignedInteger('upper_salary')->nullable();
            $table->unsignedInteger('lower_salary')->nullable();
            $table->dateTime('application_deadline')->nullable();
            $table->boolean('is_approved')->default(false);

            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->timestamps();
--}}
{{--        <x-forms.input label='Url' name='url' placeholder="https://acme.com/jobs/ceo-wanted"/>--}}
{{--        <x-forms.checkbox label="Featured (Costs Extra)" name="featured"/>--}}

        <x-forms.divider/>

{{--        <x-forms.input label='Tags(comma seperated)' name='tags' placeholder="Front-End, Backend, PHP"/>--}}
        <x-forms.button class="mt-6">Publish</x-forms.button>
    </x-forms.form>
</x-home.layout>
