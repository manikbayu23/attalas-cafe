const PageLayouts = (props) => {
    const { children } = props;
    return (
        <>
            <div className="page-layouts">
                <div className="container">
                    {children}
                </div >
            </div >
        </>
    )
}

export default PageLayouts;