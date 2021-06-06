import axios from "axios";
import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import Remove from "../Delete";

function DataTable(props) {
    const [lyrics, setLyrics] = useState([]);
    const [url, setUrl] = useState([props.endpoint]);
    const [links, setLinks] = useState([]);
    const [albums, setAlbums] = useState([]);
    const [bands, setBands] = useState([]);
    const [bandId, setBandId] = useState("");
    const [albumId, setAlbumId] = useState("");
    const filterRecord = { band_id: bandId, album_id: albumId };
    const getLyrics = async () => {
        try {
            let { data } = await axios.get(url, {
                params: filterRecord,
            });

            setLyrics(data.data);
            data.meta ? setLinks(data.meta.links) : setLinks([]);
            // setLinks(response.data.meta.links);
        } catch (e) {
            console.log(e.message);
        }
    };
    const getBands = async () => {
        let response = await axios.get("/bands/table");
        setBands(response.data);
    };
    const getAlbumBySelectedBand = async (e) => {
        setBandId(e.target.value);
        let response = await axios.get(
            `/albums/get-album-by-${e.target.value}`
        );
        setAlbums(response.data);
    };
    const filter = (e) => {
        e.preventDefault();
        getLyrics();
    };
    useEffect(() => {
        getLyrics();
        getBands();
        // getAlbumBySelectedBand();
    }, [url, albumId, bandId]);
    return (
        <div>
            <div className="row mb-3">
                <div className="col-md-6">
                    <form className="d-flex" onSubmit={filter}>
                        <select
                            value={bandId}
                            name="band"
                            id="band"
                            onChange={getAlbumBySelectedBand}
                            className="form-control mr-2"
                        >
                            <option value="">Select Band</option>
                            {bands.map((band) => {
                                return (
                                    <option value={band.id} key={band.id}>
                                        {band.name}
                                    </option>
                                );
                            })}
                        </select>
                        <select
                            value={albumId}
                            name="album"
                            id="album"
                            onChange={(e) => setAlbumId(e.target.value)}
                            className="form-control mr-2"
                        >
                            <option value="">Select Album</option>
                            {albums.map((album) => {
                                return (
                                    <option value={album.id} key={album.id}>
                                        {album.name}
                                    </option>
                                );
                            })}
                        </select>
                        <button type="submit" className="btn btn-secondary">
                            Go
                        </button>
                    </form>
                </div>
            </div>
            <div className="card">
                <div className="card-header">{props.title}</div>
                <div className="card-body">
                    <table className="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Band</th>
                                <th>Album</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            {lyrics.map((lyric) => {
                                return (
                                    <tr key={lyric.id}>
                                        <td>{lyric.title}</td>
                                        <td>{lyric.band}</td>
                                        <td>{lyric.album}</td>
                                        <td className="d-flex align-items-center">
                                            <a
                                                className="btn btn-primary mr-2 btn-sm"
                                                href={`/lyrics/${lyric.slug}/edit`}
                                            >
                                                Edit
                                            </a>
                                            <div>
                                                <Remove
                                                    className="delete d-inline"
                                                    endpoint={`/lyrics/${lyric.slug}/delete`}
                                                />
                                            </div>
                                        </td>
                                    </tr>
                                );
                            })}
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul className="pagination">
                            {links.map((link, index) => {
                                return (
                                    <li
                                        key={index}
                                        className={`page-item ${
                                            link.active ? "active" : ""
                                        }`}
                                    >
                                        <button
                                            onClick={(e) => setUrl(link.url)}
                                            className="page-link"
                                            href="#"
                                        >
                                            {link.label}
                                        </button>
                                    </li>
                                );
                            })}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    );
}

export default DataTable;

if (document.getElementById("table-of-lyric")) {
    var item = document.getElementById("table-of-lyric");
    ReactDOM.render(
        <DataTable
            title={item.getAttribute("title")}
            endpoint={item.getAttribute("endpoint")}
        />,
        item
    );
}
