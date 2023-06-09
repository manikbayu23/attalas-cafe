import SlidePageLayouts from "../components/Layouts/SlidePageLayouts";
import bgImage from '../assets/images/contact.png';
import PageLayouts from "../components/Layouts/PageLayouts";
import GridContact from "../components/Fragments/Contact";
import Head from "../components/Layouts/Head";

const Contact = () => {
    return (
        <>
            <Head title="Contact Page" description="Nimati Sensai ngopi dengan pemandangan alam Gunung dan Danau Batur di Attalas Cafe" />
            <SlidePageLayouts title="Contact Us" secondtitle="Contact Us" image={bgImage} />
            <PageLayouts>
                <GridContact />
            </PageLayouts>
        </>

    )
}

export default Contact;