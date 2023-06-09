import { Helmet } from "react-helmet"

const Head = (props) => {

    const { title, description } = props;
    return (
        <Helmet>
            <title>Attalas Cafe | {title}</title>
            <meta name="description" content={description} />
        </Helmet>
    )
}
export default Head;