<p align="center">
    <h1 align="center">WordPress tasks) Pediatric Integrative Medicine</h1>
<br>
</p>
<p><strong>Task for WordPress developer.</strong></p>

<p>List of what you need to use for the project:
    <ul>
        <li>Theme: Underscores, - remove default styling before usage.</li>
        <li>Plugins: ACF, Polylang</li>
        <li>Tech stack: HTML, SCSS, jQuery, PHP, Ajax.</li>
    </ul>
</p>
<p><strong>Task №1.</strong>
    <ul>
        <li>Develop first two sections,header and footer - following Pixel Perfect, including desktop, tablet and mobile versions</li>
        <li>Integrate with ACF and standart Wordpress widgets, language selector should be integrated with Polylang.</li>
    </ul>
<a href="https://www.figma.com/file/6nbvhPQJn3C2ThbOHzDMxA/Pediatric-
integrative-medicine?node-id=3%3A2950">Figma layout design</a>
<br>
<image src="/screenshots/1.jpg" alt="Screenshot task 1">
</p>

<p><strong>Task №2.</strong>
    <ol>
        <li>Create CPT (Custom Post Type) named "Speakers".</li>
        <li>Make 2 taxonomies named "Positions", "Countries" for CPT "Speakers"</li>
        <li>Single speaker should have following fields:
            <ul>
                <li>Title (Name of speaker)</li>
                <li>Featured Image (Photo of speaker)</li>
                <li>Content Editor (Full description, WYSIWG default editor)</li>
                <li>Sessions (post object field - ACF ). In this field admin can choose all sessions that speaker was involved in.
                    <ul>
                        <li>Add "Sessions" as an default empty CPT only with a name field.</li>
                    </ul>
                </li>
            </ul>
        </li>
    </ol>
<br>
<image src="/screenshots/2.jpg" alt="Screenshot task 2">
<br>
<strong>Custom Post Types should be created without usage of additional plugins. They have to be created with custom code, where developer has full understanding and control
over code and custom functionality. You should make all custom CPT and taxonomies, and install them as plugin.
</strong>
</p>

<p><strong>Task №3.</strong>
    <ol>
        <li>Create an CPT archive page which will include:
            <ul>
                <li>Speakers cards </li>
                <li>AJAX taxonomy filter</li>
            </ul>
            <br>
            <p>
            Dynamically display both taxonomies and it`s values. Create them as list of checkboxes, where values are responsible for filtration.
            </p>
            <p>
            Expected functionality: user go to archive page and want to see all speakers from Germany and Netherlands which are working as therapists. In order to do so user clicks a checkbox under "Countries" with appropriate values, same for "Positions". After that user sees a dynamically generated without page reload list of Speakers.
            </p>
            <p>Structure example: <strong>(Positions -> Doctor, Nurse, Medical assistant, Pharmacist, etc...)</strong> 
            </p>
            <p>
            <image src="/screenshots/3.jpg" alt="Screenshot task 3">
            </p>
        </li>
        <li>When we have more than 20 speaker cards on the page - "Load more" AJAX button should appear.</li>
    </ol>
</p>
<p><strong>Solution of the task.</strong></p>
<p>The solution to these problems is in the repository.</p>
<p>Demonstration example of site pages.<br>
    https://maze.sbs/ <br>
    https://maze.sbs/speakers/ <br>
    https://maze.sbs/speakers/amanda-tea/
</p>