import SlidePageLayouts from "../components/Layouts/SlidePageLayouts"
import bgImage from '../assets/images/about.png'
import PageLayouts from "../components/Layouts/PageLayouts"
import Head from "../components/Layouts/Head"
const About = () => {
    return (

        <>
            <Head title="About Page" description="Nimati Sensai ngopi dengan pemandangan alam Gunung dan Danau Batur di Attalas Cafe" />
            <SlidePageLayouts title="About Us" secondtitle="About Us" image={bgImage} />
            <PageLayouts>
                <h1>haloe</h1>
            </PageLayouts>
        </>
    )
}
export default About