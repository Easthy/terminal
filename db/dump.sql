--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.15
-- Dumped by pg_dump version 10.6 (Ubuntu 10.6-1.pgdg16.04+1)

-- Started on 2018-12-19 18:20:34 MSK

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE infomat_qt_sync;
--
-- TOC entry 2531 (class 1262 OID 16661272)
-- Name: infomat_qt_sync; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE infomat_qt_sync WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'ru_RU.UTF-8' LC_CTYPE = 'ru_RU.UTF-8';


ALTER DATABASE infomat_qt_sync OWNER TO postgres;

\connect infomat_qt_sync

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12397)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2534 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- TOC entry 789 (class 1247 OID 16686755)
-- Name: schedule; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.schedule AS (
	date character varying,
	start_time character varying,
	end_time character varying
);


ALTER TYPE public.schedule OWNER TO postgres;

--
-- TOC entry 262 (class 1255 OID 16661273)
-- Name: _calc_interval(timestamp without time zone, character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public._calc_interval(start_ timestamp without time zone, end_ character varying) RETURNS timestamp without time zone
    LANGUAGE plpgsql STABLE
    AS $$
BEGIN
    return (
       SELECT start_ + end_::interval
    )::timestamp;
END;
$$;


ALTER FUNCTION public._calc_interval(start_ timestamp without time zone, end_ character varying) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 195 (class 1259 OID 16661274)
-- Name: activity; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity (
    id integer NOT NULL,
    agency_id integer NOT NULL,
    type_id integer NOT NULL,
    start_date date NOT NULL,
    end_date date NOT NULL,
    name character varying(256) NOT NULL,
    description character varying(4096),
    report character varying(4096),
    email character varying(256),
    phone character varying(27),
    schedule json,
    category_id integer,
    place character varying,
    tamada character varying,
    duration integer,
    periodicity_id integer,
    state integer DEFAULT 0 NOT NULL,
    address character varying,
    created_at timestamp without time zone DEFAULT now(),
    edited_at timestamp without time zone,
    execution_state integer DEFAULT 0
);


ALTER TABLE public.activity OWNER TO postgres;

--
-- TOC entry 2535 (class 0 OID 0)
-- Dependencies: 195
-- Name: TABLE activity; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.activity IS 'Мероприятия учреждений';


--
-- TOC entry 2536 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.agency_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.agency_id IS 'учреждение';


--
-- TOC entry 2537 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.type_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.type_id IS 'тип мероприятия';


--
-- TOC entry 2538 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.start_date; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.start_date IS 'дата начала';


--
-- TOC entry 2539 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.end_date; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.end_date IS 'дата окончания';


--
-- TOC entry 2540 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.name IS 'тема мероприятия';


--
-- TOC entry 2541 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.description; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.description IS 'описание';


--
-- TOC entry 2542 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.report; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.report IS 'отчёт';


--
-- TOC entry 2543 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.email IS 'эл.почта';


--
-- TOC entry 2544 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.phone; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.phone IS 'телефон';


--
-- TOC entry 2545 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.schedule; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.schedule IS 'расписание';


--
-- TOC entry 2546 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.category_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.category_id IS 'категория';


--
-- TOC entry 2547 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.place; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.place IS 'Место проведения мероприятия';


--
-- TOC entry 2548 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.tamada; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.tamada IS 'Ведущий мероприятия';


--
-- TOC entry 2549 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.duration; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.duration IS 'Продолжительность мероприятия';


--
-- TOC entry 2550 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.state IS '0 = состояние неизменно
1 = удалено';


--
-- TOC entry 2551 (class 0 OID 0)
-- Dependencies: 195
-- Name: COLUMN activity.execution_state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity.execution_state IS '0 - мероприятие НЕ завершено
1 - мероприятие завершено';


--
-- TOC entry 196 (class 1259 OID 16661283)
-- Name: activity_category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity_category (
    id integer NOT NULL,
    name character varying(128) NOT NULL,
    icon_path character varying,
    state integer DEFAULT 0,
    image_path character varying
);


ALTER TABLE public.activity_category OWNER TO postgres;

--
-- TOC entry 2552 (class 0 OID 0)
-- Dependencies: 196
-- Name: TABLE activity_category; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.activity_category IS 'категории мероприятий';


--
-- TOC entry 2553 (class 0 OID 0)
-- Dependencies: 196
-- Name: COLUMN activity_category.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_category.name IS 'наименование';


--
-- TOC entry 2554 (class 0 OID 0)
-- Dependencies: 196
-- Name: COLUMN activity_category.icon_path; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_category.icon_path IS 'оригинальный размер';


--
-- TOC entry 197 (class 1259 OID 16661290)
-- Name: activity_category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activity_category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activity_category_id_seq OWNER TO postgres;

--
-- TOC entry 2555 (class 0 OID 0)
-- Dependencies: 197
-- Name: activity_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activity_category_id_seq OWNED BY public.activity_category.id;


--
-- TOC entry 198 (class 1259 OID 16661292)
-- Name: activity_event; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity_event (
    id integer NOT NULL,
    activity_id integer NOT NULL,
    start_time time without time zone NOT NULL,
    end_time time without time zone NOT NULL,
    date date NOT NULL,
    report character varying(4096),
    duration integer,
    tamada character varying,
    address character varying,
    place character varying,
    state integer DEFAULT 0 NOT NULL,
    execution_state integer DEFAULT 1,
    created_at timestamp without time zone DEFAULT now(),
    edited_at timestamp without time zone
);


ALTER TABLE public.activity_event OWNER TO postgres;

--
-- TOC entry 2556 (class 0 OID 0)
-- Dependencies: 198
-- Name: TABLE activity_event; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.activity_event IS 'события мероприятий';


--
-- TOC entry 2557 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN activity_event.activity_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_event.activity_id IS 'мероприятие';


--
-- TOC entry 2558 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN activity_event.start_time; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_event.start_time IS 'время начала';


--
-- TOC entry 2559 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN activity_event.end_time; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_event.end_time IS 'время окончания';


--
-- TOC entry 2560 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN activity_event.date; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_event.date IS 'дата';


--
-- TOC entry 2561 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN activity_event.report; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_event.report IS 'отчёт';


--
-- TOC entry 2562 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN activity_event.duration; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_event.duration IS 'Продолжительность мероприятия';


--
-- TOC entry 2563 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN activity_event.tamada; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_event.tamada IS 'Ведущие, которые провели событие';


--
-- TOC entry 199 (class 1259 OID 16661301)
-- Name: activity_event_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activity_event_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activity_event_id_seq OWNER TO postgres;

--
-- TOC entry 2564 (class 0 OID 0)
-- Dependencies: 199
-- Name: activity_event_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activity_event_id_seq OWNED BY public.activity_event.id;


--
-- TOC entry 200 (class 1259 OID 16661303)
-- Name: activity_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activity_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activity_id_seq OWNER TO postgres;

--
-- TOC entry 2565 (class 0 OID 0)
-- Dependencies: 200
-- Name: activity_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activity_id_seq OWNED BY public.activity.id;


--
-- TOC entry 201 (class 1259 OID 16661305)
-- Name: activity_periodicity; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity_periodicity (
    id integer NOT NULL,
    name character varying NOT NULL
);


ALTER TABLE public.activity_periodicity OWNER TO postgres;

--
-- TOC entry 2566 (class 0 OID 0)
-- Dependencies: 201
-- Name: TABLE activity_periodicity; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.activity_periodicity IS 'Периодичность мероприятий';


--
-- TOC entry 202 (class 1259 OID 16661311)
-- Name: activity_periodicity_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activity_periodicity_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activity_periodicity_id_seq OWNER TO postgres;

--
-- TOC entry 2567 (class 0 OID 0)
-- Dependencies: 202
-- Name: activity_periodicity_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activity_periodicity_id_seq OWNED BY public.activity_periodicity.id;


--
-- TOC entry 203 (class 1259 OID 16661313)
-- Name: activity_photo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity_photo (
    id integer NOT NULL,
    activity_id integer NOT NULL,
    path character varying,
    event_id integer,
    description character varying,
    state integer DEFAULT 0
);


ALTER TABLE public.activity_photo OWNER TO postgres;

--
-- TOC entry 2568 (class 0 OID 0)
-- Dependencies: 203
-- Name: COLUMN activity_photo.activity_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_photo.activity_id IS '"Москва город долголетия" мероприятие';


--
-- TOC entry 2569 (class 0 OID 0)
-- Dependencies: 203
-- Name: COLUMN activity_photo.path; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_photo.path IS 'оригинальный размер';


--
-- TOC entry 2570 (class 0 OID 0)
-- Dependencies: 203
-- Name: COLUMN activity_photo.event_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_photo.event_id IS 'событие';


--
-- TOC entry 204 (class 1259 OID 16661320)
-- Name: activity_photo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activity_photo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activity_photo_id_seq OWNER TO postgres;

--
-- TOC entry 2571 (class 0 OID 0)
-- Dependencies: 204
-- Name: activity_photo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activity_photo_id_seq OWNED BY public.activity_photo.id;


--
-- TOC entry 205 (class 1259 OID 16661322)
-- Name: activity_type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity_type (
    id integer NOT NULL,
    name character varying(128) NOT NULL,
    state integer DEFAULT 0
);


ALTER TABLE public.activity_type OWNER TO postgres;

--
-- TOC entry 2572 (class 0 OID 0)
-- Dependencies: 205
-- Name: TABLE activity_type; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.activity_type IS 'типы мероприятий';


--
-- TOC entry 2573 (class 0 OID 0)
-- Dependencies: 205
-- Name: COLUMN activity_type.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_type.name IS 'наименование';


--
-- TOC entry 206 (class 1259 OID 16661326)
-- Name: activity_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activity_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activity_type_id_seq OWNER TO postgres;

--
-- TOC entry 2574 (class 0 OID 0)
-- Dependencies: 206
-- Name: activity_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activity_type_id_seq OWNED BY public.activity_type.id;


--
-- TOC entry 207 (class 1259 OID 16661328)
-- Name: activity_visitor_register; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity_visitor_register (
    event integer NOT NULL,
    visitor_id integer NOT NULL,
    reg_state integer DEFAULT 0,
    vis_state integer DEFAULT 0
);


ALTER TABLE public.activity_visitor_register OWNER TO postgres;

--
-- TOC entry 2575 (class 0 OID 0)
-- Dependencies: 207
-- Name: TABLE activity_visitor_register; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.activity_visitor_register IS 'журнал';


--
-- TOC entry 2576 (class 0 OID 0)
-- Dependencies: 207
-- Name: COLUMN activity_visitor_register.event; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_visitor_register.event IS 'событие';


--
-- TOC entry 2577 (class 0 OID 0)
-- Dependencies: 207
-- Name: COLUMN activity_visitor_register.visitor_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.activity_visitor_register.visitor_id IS 'участник, сотрудник учреждения';


--
-- TOC entry 208 (class 1259 OID 16661333)
-- Name: agency; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.agency (
    id integer NOT NULL,
    district_id integer DEFAULT 1,
    headagency_id integer,
    fullname character varying(256),
    shortname character varying(256),
    phone character varying(256),
    address character varying(3000),
    email character varying(75),
    www character varying(200),
    description text,
    edited_at timestamp without time zone,
    created_at timestamp without time zone,
    inn character varying(50),
    timetable json DEFAULT '{"mon":"f","monstart":"09:00","monend":"18:00","tue":"f","tuestart":"09:00","tueend":"18:00","wen":"f","wenstart":"09:00","wenend":"18:00","thu":"f","thustart":"09:00","thuend":"18:00","fri":"f","fristart":"09:00","friend":"18:00","sat":"f","satstart":"09:00","satend":"18:00","sun":"f","sunstart":"09:00","sunend":"18:00","break_start":"13:00", "break_end":"14:00"}'::json,
    address_comment character varying,
    coords character varying,
    okato character varying,
    region_id integer,
    state integer DEFAULT 0
);


ALTER TABLE public.agency OWNER TO postgres;

--
-- TOC entry 2578 (class 0 OID 0)
-- Dependencies: 208
-- Name: COLUMN agency.state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.agency.state IS 'Состояние записи
0 - без изменений
1 - удалено';


--
-- TOC entry 209 (class 1259 OID 16661342)
-- Name: city_district; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.city_district (
    id integer NOT NULL,
    fullname character varying(256) NOT NULL,
    shortname character varying(256) NOT NULL,
    description text,
    state integer DEFAULT 0
);


ALTER TABLE public.city_district OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 16661349)
-- Name: agency_district_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.agency_district_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.agency_district_id_seq OWNER TO postgres;

--
-- TOC entry 2579 (class 0 OID 0)
-- Dependencies: 210
-- Name: agency_district_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.agency_district_id_seq OWNED BY public.city_district.id;


--
-- TOC entry 211 (class 1259 OID 16661351)
-- Name: agency_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.agency_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.agency_id_seq OWNER TO postgres;

--
-- TOC entry 2580 (class 0 OID 0)
-- Dependencies: 211
-- Name: agency_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.agency_id_seq OWNED BY public.agency.id;


--
-- TOC entry 212 (class 1259 OID 16661353)
-- Name: agency_management; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.agency_management (
    id integer NOT NULL,
    surname character varying(256) NOT NULL,
    firstname character varying(256) NOT NULL,
    fathername character varying(256) NOT NULL,
    agency_id integer NOT NULL,
    post character varying(256) NOT NULL,
    phone character varying(256),
    path character varying,
    state integer DEFAULT 0
);


ALTER TABLE public.agency_management OWNER TO postgres;

--
-- TOC entry 2581 (class 0 OID 0)
-- Dependencies: 212
-- Name: TABLE agency_management; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.agency_management IS 'Руководство учреждения';


--
-- TOC entry 2582 (class 0 OID 0)
-- Dependencies: 212
-- Name: COLUMN agency_management.state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.agency_management.state IS '0 - неизменное состояние
1 - удалено';


--
-- TOC entry 213 (class 1259 OID 16661360)
-- Name: agency_management_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.agency_management_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.agency_management_id_seq OWNER TO postgres;

--
-- TOC entry 2583 (class 0 OID 0)
-- Dependencies: 213
-- Name: agency_management_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.agency_management_id_seq OWNED BY public.agency_management.id;


--
-- TOC entry 214 (class 1259 OID 16661362)
-- Name: agency_photo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.agency_photo (
    id integer NOT NULL,
    agency_id integer,
    description character varying(256),
    path character varying,
    photo_album_id integer,
    state integer DEFAULT 0
);


ALTER TABLE public.agency_photo OWNER TO postgres;

--
-- TOC entry 2584 (class 0 OID 0)
-- Dependencies: 214
-- Name: COLUMN agency_photo.state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.agency_photo.state IS 'Состояние записи
0 - без изменений
1 - удалено';


--
-- TOC entry 215 (class 1259 OID 16661369)
-- Name: agency_photo_album; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.agency_photo_album (
    id integer NOT NULL,
    name character varying,
    agency_id integer NOT NULL,
    state integer DEFAULT 0,
    description character varying
);


ALTER TABLE public.agency_photo_album OWNER TO postgres;

--
-- TOC entry 2585 (class 0 OID 0)
-- Dependencies: 215
-- Name: TABLE agency_photo_album; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.agency_photo_album IS 'Фотогалерея';


--
-- TOC entry 2586 (class 0 OID 0)
-- Dependencies: 215
-- Name: COLUMN agency_photo_album.state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.agency_photo_album.state IS 'Состояние записи.
0 - без изменений
1 - удалена';


--
-- TOC entry 216 (class 1259 OID 16661376)
-- Name: agency_photo_album_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.agency_photo_album_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.agency_photo_album_id_seq OWNER TO postgres;

--
-- TOC entry 2587 (class 0 OID 0)
-- Dependencies: 216
-- Name: agency_photo_album_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.agency_photo_album_id_seq OWNED BY public.agency_photo_album.id;


--
-- TOC entry 217 (class 1259 OID 16661378)
-- Name: agency_photo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.agency_photo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.agency_photo_id_seq OWNER TO postgres;

--
-- TOC entry 2588 (class 0 OID 0)
-- Dependencies: 217
-- Name: agency_photo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.agency_photo_id_seq OWNED BY public.agency_photo.id;


--
-- TOC entry 261 (class 1259 OID 16686757)
-- Name: calendar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.calendar (
    date date,
    dow double precision,
    day text,
    "iso year" double precision,
    week double precision,
    feb double precision,
    year double precision,
    leap boolean
);


ALTER TABLE public.calendar OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 16661380)
-- Name: city_activity; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.city_activity (
    id integer NOT NULL,
    agency_id integer,
    type_id integer,
    start_date date NOT NULL,
    end_date date NOT NULL,
    name character varying(256) NOT NULL,
    description character varying(4096),
    report character varying(4096),
    email character varying(256),
    phone character varying(27),
    schedule json,
    category_id integer,
    place character varying,
    tamada character varying,
    duration integer,
    periodicity_id integer,
    state integer DEFAULT 0 NOT NULL,
    address character varying,
    created_at timestamp without time zone DEFAULT now(),
    edited_at timestamp without time zone,
    execution_state integer DEFAULT 0
);


ALTER TABLE public.city_activity OWNER TO postgres;

--
-- TOC entry 2589 (class 0 OID 0)
-- Dependencies: 218
-- Name: TABLE city_activity; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.city_activity IS 'Общегородские мероприятия';


--
-- TOC entry 2590 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.agency_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.agency_id IS 'учреждение';


--
-- TOC entry 2591 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.type_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.type_id IS 'тип мероприятия';


--
-- TOC entry 2592 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.start_date; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.start_date IS 'дата начала';


--
-- TOC entry 2593 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.end_date; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.end_date IS 'дата окончания';


--
-- TOC entry 2594 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.name IS 'тема мероприятия';


--
-- TOC entry 2595 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.description; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.description IS 'описание';


--
-- TOC entry 2596 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.report; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.report IS 'отчёт';


--
-- TOC entry 2597 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.email IS 'эл.почта';


--
-- TOC entry 2598 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.phone; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.phone IS 'телефон';


--
-- TOC entry 2599 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.schedule; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.schedule IS 'расписание';


--
-- TOC entry 2600 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.category_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.category_id IS 'категория общегородских мероприятий';


--
-- TOC entry 2601 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.place; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.place IS 'Место проведения мероприятия';


--
-- TOC entry 2602 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.duration; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.duration IS 'Продолжительность мероприятия';


--
-- TOC entry 2603 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.state IS '0 = состояние неизменно
1 = удалено';


--
-- TOC entry 2604 (class 0 OID 0)
-- Dependencies: 218
-- Name: COLUMN city_activity.execution_state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity.execution_state IS '0 - мероприятие НЕ завершено
1 - мероприятие завершено';


--
-- TOC entry 219 (class 1259 OID 16661389)
-- Name: city_activity_category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.city_activity_category (
    id integer NOT NULL,
    name character varying(128) NOT NULL,
    icon_path character varying,
    state integer DEFAULT 0,
    image_path character varying
);


ALTER TABLE public.city_activity_category OWNER TO postgres;

--
-- TOC entry 2605 (class 0 OID 0)
-- Dependencies: 219
-- Name: TABLE city_activity_category; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.city_activity_category IS 'Категории общегородских мероприятий';


--
-- TOC entry 2606 (class 0 OID 0)
-- Dependencies: 219
-- Name: COLUMN city_activity_category.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity_category.name IS 'наименование';


--
-- TOC entry 2607 (class 0 OID 0)
-- Dependencies: 219
-- Name: COLUMN city_activity_category.icon_path; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity_category.icon_path IS 'иконка';


--
-- TOC entry 2608 (class 0 OID 0)
-- Dependencies: 219
-- Name: COLUMN city_activity_category.image_path; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.city_activity_category.image_path IS 'логотип';


--
-- TOC entry 220 (class 1259 OID 16661396)
-- Name: city_activity_category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.city_activity_category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.city_activity_category_id_seq OWNER TO postgres;

--
-- TOC entry 2609 (class 0 OID 0)
-- Dependencies: 220
-- Name: city_activity_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.city_activity_category_id_seq OWNED BY public.city_activity_category.id;


--
-- TOC entry 221 (class 1259 OID 16661398)
-- Name: city_activity_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.city_activity_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.city_activity_id_seq OWNER TO postgres;

--
-- TOC entry 2610 (class 0 OID 0)
-- Dependencies: 221
-- Name: city_activity_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.city_activity_id_seq OWNED BY public.city_activity.id;


--
-- TOC entry 222 (class 1259 OID 16661400)
-- Name: city_activity_photo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.city_activity_photo (
    id integer NOT NULL,
    activity_id integer NOT NULL,
    path character varying,
    event_id integer,
    description character varying,
    state integer
);


ALTER TABLE public.city_activity_photo OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 16661406)
-- Name: city_activity_photo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.city_activity_photo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.city_activity_photo_id_seq OWNER TO postgres;

--
-- TOC entry 2611 (class 0 OID 0)
-- Dependencies: 223
-- Name: city_activity_photo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.city_activity_photo_id_seq OWNED BY public.city_activity_photo.id;


--
-- TOC entry 224 (class 1259 OID 16661408)
-- Name: city_region; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.city_region (
    id integer NOT NULL,
    name character varying NOT NULL,
    state integer DEFAULT 1,
    district_id integer,
    description character varying
);


ALTER TABLE public.city_region OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 16661415)
-- Name: city_region_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.city_region_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.city_region_id_seq OWNER TO postgres;

--
-- TOC entry 2612 (class 0 OID 0)
-- Dependencies: 225
-- Name: city_region_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.city_region_id_seq OWNED BY public.city_region.id;


--
-- TOC entry 226 (class 1259 OID 16661417)
-- Name: department_management; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.department_management (
    id integer NOT NULL,
    surname character varying(256) NOT NULL,
    firstname character varying(256) NOT NULL,
    fathername character varying(256) NOT NULL,
    agency_id integer,
    post character varying(256) NOT NULL,
    phone character varying(256),
    path character varying,
    state integer DEFAULT 0
);


ALTER TABLE public.department_management OWNER TO postgres;

--
-- TOC entry 2613 (class 0 OID 0)
-- Dependencies: 226
-- Name: TABLE department_management; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.department_management IS 'Руководство департамента';


--
-- TOC entry 2614 (class 0 OID 0)
-- Dependencies: 226
-- Name: COLUMN department_management.state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.department_management.state IS '0 - неизменное состояние
1 - удалено';


--
-- TOC entry 227 (class 1259 OID 16661424)
-- Name: department_management_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.department_management_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.department_management_id_seq OWNER TO postgres;

--
-- TOC entry 2615 (class 0 OID 0)
-- Dependencies: 227
-- Name: department_management_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.department_management_id_seq OWNED BY public.department_management.id;


--
-- TOC entry 228 (class 1259 OID 16661426)
-- Name: long_life_activity; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.long_life_activity (
    id integer NOT NULL,
    agency_id integer,
    type_id integer,
    start_date date NOT NULL,
    end_date date NOT NULL,
    name character varying(256) NOT NULL,
    description character varying(4096),
    report character varying(4096),
    email character varying(256),
    phone character varying(27),
    schedule json,
    category_id integer,
    place character varying,
    tamada character varying,
    duration integer,
    periodicity_id integer,
    state integer DEFAULT 0 NOT NULL,
    address character varying,
    created_at timestamp without time zone DEFAULT now(),
    edited_at timestamp without time zone,
    execution_state integer DEFAULT 0
);


ALTER TABLE public.long_life_activity OWNER TO postgres;

--
-- TOC entry 2616 (class 0 OID 0)
-- Dependencies: 228
-- Name: TABLE long_life_activity; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.long_life_activity IS 'Мероприятия "Москва город долголетия"';


--
-- TOC entry 2617 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.agency_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.agency_id IS 'учреждение';


--
-- TOC entry 2618 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.type_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.type_id IS 'тип мероприятия';


--
-- TOC entry 2619 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.start_date; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.start_date IS 'дата начала';


--
-- TOC entry 2620 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.end_date; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.end_date IS 'дата окончания';


--
-- TOC entry 2621 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.name IS 'тема мероприятия';


--
-- TOC entry 2622 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.description; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.description IS 'описание';


--
-- TOC entry 2623 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.report; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.report IS 'отчёт';


--
-- TOC entry 2624 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.email IS 'эл.почта';


--
-- TOC entry 2625 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.phone; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.phone IS 'телефон';


--
-- TOC entry 2626 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.schedule; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.schedule IS 'расписание';


--
-- TOC entry 2627 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.category_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.category_id IS 'категория мероприятий Москва город долголетия';


--
-- TOC entry 2628 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.place; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.place IS 'Место проведения мероприятия';


--
-- TOC entry 2629 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.duration; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.duration IS 'Продолжительность мероприятия';


--
-- TOC entry 2630 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.state IS '0 = состояние неизменно
1 = удалено';


--
-- TOC entry 2631 (class 0 OID 0)
-- Dependencies: 228
-- Name: COLUMN long_life_activity.execution_state; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity.execution_state IS '0 - мероприятие НЕ завершено
1 - мероприятие завершено';


--
-- TOC entry 229 (class 1259 OID 16661435)
-- Name: long_life_activity_category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.long_life_activity_category (
    id integer NOT NULL,
    name character varying(128) NOT NULL,
    icon_path character varying,
    state integer DEFAULT 0,
    image_path character varying
);


ALTER TABLE public.long_life_activity_category OWNER TO postgres;

--
-- TOC entry 2632 (class 0 OID 0)
-- Dependencies: 229
-- Name: TABLE long_life_activity_category; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.long_life_activity_category IS 'Категории мероприятий Москва город долголетия';


--
-- TOC entry 2633 (class 0 OID 0)
-- Dependencies: 229
-- Name: COLUMN long_life_activity_category.name; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity_category.name IS 'наименование';


--
-- TOC entry 2634 (class 0 OID 0)
-- Dependencies: 229
-- Name: COLUMN long_life_activity_category.icon_path; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity_category.icon_path IS 'иконка';


--
-- TOC entry 2635 (class 0 OID 0)
-- Dependencies: 229
-- Name: COLUMN long_life_activity_category.image_path; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.long_life_activity_category.image_path IS 'логотип';


--
-- TOC entry 230 (class 1259 OID 16661442)
-- Name: long_life_activity_category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.long_life_activity_category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.long_life_activity_category_id_seq OWNER TO postgres;

--
-- TOC entry 2636 (class 0 OID 0)
-- Dependencies: 230
-- Name: long_life_activity_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.long_life_activity_category_id_seq OWNED BY public.long_life_activity_category.id;


--
-- TOC entry 231 (class 1259 OID 16661444)
-- Name: long_life_activity_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.long_life_activity_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.long_life_activity_id_seq OWNER TO postgres;

--
-- TOC entry 2637 (class 0 OID 0)
-- Dependencies: 231
-- Name: long_life_activity_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.long_life_activity_id_seq OWNED BY public.long_life_activity.id;


--
-- TOC entry 232 (class 1259 OID 16661446)
-- Name: long_life_activity_photo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.long_life_activity_photo (
    id integer NOT NULL,
    activity_id integer NOT NULL,
    path character varying,
    event_id integer,
    description character varying,
    state integer DEFAULT 0
);


ALTER TABLE public.long_life_activity_photo OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 16661453)
-- Name: long_life_activity_photo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.long_life_activity_photo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.long_life_activity_photo_id_seq OWNER TO postgres;

--
-- TOC entry 2638 (class 0 OID 0)
-- Dependencies: 233
-- Name: long_life_activity_photo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.long_life_activity_photo_id_seq OWNED BY public.long_life_activity_photo.id;


--
-- TOC entry 234 (class 1259 OID 16661455)
-- Name: screen_file; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.screen_file (
    id integer NOT NULL,
    screensaver_id integer NOT NULL,
    link_file character varying(256) NOT NULL
);


ALTER TABLE public.screen_file OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 16661458)
-- Name: screen_file_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.screen_file_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.screen_file_id_seq OWNER TO postgres;

--
-- TOC entry 2639 (class 0 OID 0)
-- Dependencies: 235
-- Name: screen_file_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.screen_file_id_seq OWNED BY public.screen_file.id;


--
-- TOC entry 236 (class 1259 OID 16661460)
-- Name: screen_saver; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.screen_saver (
    id integer NOT NULL,
    name character varying(256) NOT NULL,
    description text,
    active boolean NOT NULL,
    agency_id integer
);


ALTER TABLE public.screen_saver OWNER TO postgres;

--
-- TOC entry 237 (class 1259 OID 16661466)
-- Name: screen_saver_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.screen_saver_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.screen_saver_id_seq OWNER TO postgres;

--
-- TOC entry 2640 (class 0 OID 0)
-- Dependencies: 237
-- Name: screen_saver_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.screen_saver_id_seq OWNED BY public.screen_saver.id;


--
-- TOC entry 238 (class 1259 OID 16661468)
-- Name: service; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.service (
    id integer NOT NULL,
    name character varying,
    agency_resources character varying,
    client_resources character varying,
    description character varying,
    result character varying,
    "time" integer,
    comment character varying,
    price numeric(10,2) DEFAULT 0,
    price_hour numeric(10,2) DEFAULT 0,
    category_id integer,
    code character varying,
    type_id integer,
    path character varying,
    location_type_id integer,
    level integer,
    periodicity_id integer,
    frequence integer,
    state integer DEFAULT 0,
    urgent integer DEFAULT 0
);


ALTER TABLE public.service OWNER TO postgres;

--
-- TOC entry 2641 (class 0 OID 0)
-- Dependencies: 238
-- Name: COLUMN service.periodicity_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.service.periodicity_id IS 'Периодичность оказания услуги согласно нормативам';


--
-- TOC entry 2642 (class 0 OID 0)
-- Dependencies: 238
-- Name: COLUMN service.frequence; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.service.frequence IS 'Частота оказания услуги согласно нормативам';


--
-- TOC entry 239 (class 1259 OID 16661478)
-- Name: service_category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.service_category (
    id integer NOT NULL,
    text character varying,
    icon_path character varying,
    state integer DEFAULT 0,
    image_path character varying
);


ALTER TABLE public.service_category OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 16661485)
-- Name: service_category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.service_category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_category_id_seq OWNER TO postgres;

--
-- TOC entry 2643 (class 0 OID 0)
-- Dependencies: 240
-- Name: service_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.service_category_id_seq OWNED BY public.service_category.id;


--
-- TOC entry 241 (class 1259 OID 16661487)
-- Name: service_chargeable_type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.service_chargeable_type (
    id integer NOT NULL,
    text character varying
);


ALTER TABLE public.service_chargeable_type OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 16661493)
-- Name: service_chargeable_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.service_chargeable_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_chargeable_type_id_seq OWNER TO postgres;

--
-- TOC entry 2644 (class 0 OID 0)
-- Dependencies: 242
-- Name: service_chargeable_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.service_chargeable_type_id_seq OWNED BY public.service_chargeable_type.id;


--
-- TOC entry 243 (class 1259 OID 16661495)
-- Name: service_chargeable_type_to_service; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.service_chargeable_type_to_service (
    id integer NOT NULL,
    service_id integer,
    chargeable_type_id integer,
    factor numeric(10,2) DEFAULT 0
);


ALTER TABLE public.service_chargeable_type_to_service OWNER TO postgres;

--
-- TOC entry 244 (class 1259 OID 16661499)
-- Name: service_chargeable_type_to_service_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.service_chargeable_type_to_service_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_chargeable_type_to_service_id_seq OWNER TO postgres;

--
-- TOC entry 2645 (class 0 OID 0)
-- Dependencies: 244
-- Name: service_chargeable_type_to_service_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.service_chargeable_type_to_service_id_seq OWNED BY public.service_chargeable_type_to_service.id;


--
-- TOC entry 245 (class 1259 OID 16661501)
-- Name: service_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.service_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_id_seq OWNER TO postgres;

--
-- TOC entry 2646 (class 0 OID 0)
-- Dependencies: 245
-- Name: service_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.service_id_seq OWNED BY public.service.id;


--
-- TOC entry 246 (class 1259 OID 16661503)
-- Name: service_location_type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.service_location_type (
    id integer NOT NULL,
    text character varying
);


ALTER TABLE public.service_location_type OWNER TO postgres;

--
-- TOC entry 247 (class 1259 OID 16661509)
-- Name: service_location_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.service_location_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_location_type_id_seq OWNER TO postgres;

--
-- TOC entry 2647 (class 0 OID 0)
-- Dependencies: 247
-- Name: service_location_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.service_location_type_id_seq OWNED BY public.service_location_type.id;


--
-- TOC entry 248 (class 1259 OID 16661511)
-- Name: service_to_agency; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.service_to_agency (
    id integer NOT NULL,
    service_id integer,
    agency_id integer,
    state integer DEFAULT 0
);


ALTER TABLE public.service_to_agency OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 16661515)
-- Name: service_to_agency_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.service_to_agency_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_to_agency_id_seq OWNER TO postgres;

--
-- TOC entry 2648 (class 0 OID 0)
-- Dependencies: 249
-- Name: service_to_agency_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.service_to_agency_id_seq OWNED BY public.service_to_agency.id;


--
-- TOC entry 250 (class 1259 OID 16661517)
-- Name: service_tree; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.service_tree (
    ancestor integer NOT NULL,
    descendant integer NOT NULL,
    length integer
);


ALTER TABLE public.service_tree OWNER TO postgres;

--
-- TOC entry 2649 (class 0 OID 0)
-- Dependencies: 250
-- Name: TABLE service_tree; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.service_tree IS 'дерево групп';


--
-- TOC entry 2650 (class 0 OID 0)
-- Dependencies: 250
-- Name: COLUMN service_tree.ancestor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.service_tree.ancestor IS 'предок';


--
-- TOC entry 2651 (class 0 OID 0)
-- Dependencies: 250
-- Name: COLUMN service_tree.descendant; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.service_tree.descendant IS 'потомок';


--
-- TOC entry 2652 (class 0 OID 0)
-- Dependencies: 250
-- Name: COLUMN service_tree.length; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.service_tree.length IS 'Значение path_length ссылки узла на самого себя равно 0, 
значение path_length прямого дочернего объекта этого узла равно 1, значение path_length внучатого объекта узла равно 2 и  так далее.';


--
-- TOC entry 251 (class 1259 OID 16661520)
-- Name: service_type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.service_type (
    id integer NOT NULL,
    text character varying
);


ALTER TABLE public.service_type OWNER TO postgres;

--
-- TOC entry 252 (class 1259 OID 16661526)
-- Name: service_type_id_pkey; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.service_type_id_pkey
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.service_type_id_pkey OWNER TO postgres;

--
-- TOC entry 2653 (class 0 OID 0)
-- Dependencies: 252
-- Name: service_type_id_pkey; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.service_type_id_pkey OWNED BY public.service_type.id;


--
-- TOC entry 253 (class 1259 OID 16661528)
-- Name: sh_list; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sh_list (
    id integer NOT NULL,
    sh_code text,
    state integer DEFAULT 0,
    executed integer DEFAULT 0,
    infomat_id integer,
    sh_name character varying
);


ALTER TABLE public.sh_list OWNER TO postgres;

--
-- TOC entry 254 (class 1259 OID 16661536)
-- Name: sh_list_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sh_list_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sh_list_id_seq OWNER TO postgres;

--
-- TOC entry 2654 (class 0 OID 0)
-- Dependencies: 254
-- Name: sh_list_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sh_list_id_seq OWNED BY public.sh_list.id;


--
-- TOC entry 255 (class 1259 OID 16661538)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    agency_id integer,
    username character varying(50),
    password character varying(255),
    role integer DEFAULT 0,
    created timestamp without time zone,
    modified timestamp without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 256 (class 1259 OID 16661542)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 2655 (class 0 OID 0)
-- Dependencies: 256
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 257 (class 1259 OID 16661544)
-- Name: visitor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.visitor (
    id integer NOT NULL,
    identifier character varying(512),
    agency integer[],
    surname character varying,
    firstname character varying,
    fathername character varying,
    state integer DEFAULT 0
);


ALTER TABLE public.visitor OWNER TO postgres;

--
-- TOC entry 2656 (class 0 OID 0)
-- Dependencies: 257
-- Name: TABLE visitor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.visitor IS 'Список посетителей мероприятий';


--
-- TOC entry 2657 (class 0 OID 0)
-- Dependencies: 257
-- Name: COLUMN visitor.identifier; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.visitor.identifier IS 'Идентификатор посетителя';


--
-- TOC entry 2658 (class 0 OID 0)
-- Dependencies: 257
-- Name: COLUMN visitor.agency; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.visitor.agency IS 'Учреждения, к-м принадлежит посетитель';


--
-- TOC entry 258 (class 1259 OID 16661551)
-- Name: visitor_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.visitor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.visitor_id_seq OWNER TO postgres;

--
-- TOC entry 2659 (class 0 OID 0)
-- Dependencies: 258
-- Name: visitor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.visitor_id_seq OWNED BY public.visitor.id;


--
-- TOC entry 259 (class 1259 OID 16679528)
-- Name: weather; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.weather (
    load_date timestamp without time zone NOT NULL,
    temperature numeric(5,2),
    weather_json jsonb
);


ALTER TABLE public.weather OWNER TO postgres;

--
-- TOC entry 2267 (class 2604 OID 16661553)
-- Name: activity id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity ALTER COLUMN id SET DEFAULT nextval('public.activity_id_seq'::regclass);


--
-- TOC entry 2269 (class 2604 OID 16661554)
-- Name: activity_category id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_category ALTER COLUMN id SET DEFAULT nextval('public.activity_category_id_seq'::regclass);


--
-- TOC entry 2273 (class 2604 OID 16661555)
-- Name: activity_event id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_event ALTER COLUMN id SET DEFAULT nextval('public.activity_event_id_seq'::regclass);


--
-- TOC entry 2274 (class 2604 OID 16661556)
-- Name: activity_periodicity id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_periodicity ALTER COLUMN id SET DEFAULT nextval('public.activity_periodicity_id_seq'::regclass);


--
-- TOC entry 2276 (class 2604 OID 16661557)
-- Name: activity_photo id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_photo ALTER COLUMN id SET DEFAULT nextval('public.activity_photo_id_seq'::regclass);


--
-- TOC entry 2278 (class 2604 OID 16661558)
-- Name: activity_type id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_type ALTER COLUMN id SET DEFAULT nextval('public.activity_type_id_seq'::regclass);


--
-- TOC entry 2284 (class 2604 OID 16661559)
-- Name: agency id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agency ALTER COLUMN id SET DEFAULT nextval('public.agency_id_seq'::regclass);


--
-- TOC entry 2288 (class 2604 OID 16661560)
-- Name: agency_management id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agency_management ALTER COLUMN id SET DEFAULT nextval('public.agency_management_id_seq'::regclass);


--
-- TOC entry 2290 (class 2604 OID 16661561)
-- Name: agency_photo id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agency_photo ALTER COLUMN id SET DEFAULT nextval('public.agency_photo_id_seq'::regclass);


--
-- TOC entry 2292 (class 2604 OID 16661562)
-- Name: agency_photo_album id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agency_photo_album ALTER COLUMN id SET DEFAULT nextval('public.agency_photo_album_id_seq'::regclass);


--
-- TOC entry 2296 (class 2604 OID 16661563)
-- Name: city_activity id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_activity ALTER COLUMN id SET DEFAULT nextval('public.city_activity_id_seq'::regclass);


--
-- TOC entry 2298 (class 2604 OID 16661564)
-- Name: city_activity_category id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_activity_category ALTER COLUMN id SET DEFAULT nextval('public.city_activity_category_id_seq'::regclass);


--
-- TOC entry 2299 (class 2604 OID 16661565)
-- Name: city_activity_photo id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_activity_photo ALTER COLUMN id SET DEFAULT nextval('public.city_activity_photo_id_seq'::regclass);


--
-- TOC entry 2286 (class 2604 OID 16661566)
-- Name: city_district id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_district ALTER COLUMN id SET DEFAULT nextval('public.agency_district_id_seq'::regclass);


--
-- TOC entry 2301 (class 2604 OID 16661567)
-- Name: city_region id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_region ALTER COLUMN id SET DEFAULT nextval('public.city_region_id_seq'::regclass);


--
-- TOC entry 2303 (class 2604 OID 16661568)
-- Name: department_management id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.department_management ALTER COLUMN id SET DEFAULT nextval('public.department_management_id_seq'::regclass);


--
-- TOC entry 2307 (class 2604 OID 16661569)
-- Name: long_life_activity id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.long_life_activity ALTER COLUMN id SET DEFAULT nextval('public.long_life_activity_id_seq'::regclass);


--
-- TOC entry 2309 (class 2604 OID 16661570)
-- Name: long_life_activity_category id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.long_life_activity_category ALTER COLUMN id SET DEFAULT nextval('public.long_life_activity_category_id_seq'::regclass);


--
-- TOC entry 2311 (class 2604 OID 16661571)
-- Name: long_life_activity_photo id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.long_life_activity_photo ALTER COLUMN id SET DEFAULT nextval('public.long_life_activity_photo_id_seq'::regclass);


--
-- TOC entry 2312 (class 2604 OID 16661572)
-- Name: screen_file id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.screen_file ALTER COLUMN id SET DEFAULT nextval('public.screen_file_id_seq'::regclass);


--
-- TOC entry 2313 (class 2604 OID 16661573)
-- Name: screen_saver id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.screen_saver ALTER COLUMN id SET DEFAULT nextval('public.screen_saver_id_seq'::regclass);


--
-- TOC entry 2318 (class 2604 OID 16661574)
-- Name: service id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service ALTER COLUMN id SET DEFAULT nextval('public.service_id_seq'::regclass);


--
-- TOC entry 2320 (class 2604 OID 16661575)
-- Name: service_category id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_category ALTER COLUMN id SET DEFAULT nextval('public.service_category_id_seq'::regclass);


--
-- TOC entry 2321 (class 2604 OID 16661576)
-- Name: service_chargeable_type id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_chargeable_type ALTER COLUMN id SET DEFAULT nextval('public.service_chargeable_type_id_seq'::regclass);


--
-- TOC entry 2323 (class 2604 OID 16661577)
-- Name: service_chargeable_type_to_service id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_chargeable_type_to_service ALTER COLUMN id SET DEFAULT nextval('public.service_chargeable_type_to_service_id_seq'::regclass);


--
-- TOC entry 2324 (class 2604 OID 16661578)
-- Name: service_location_type id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_location_type ALTER COLUMN id SET DEFAULT nextval('public.service_location_type_id_seq'::regclass);


--
-- TOC entry 2326 (class 2604 OID 16661579)
-- Name: service_to_agency id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_to_agency ALTER COLUMN id SET DEFAULT nextval('public.service_to_agency_id_seq'::regclass);


--
-- TOC entry 2327 (class 2604 OID 16661580)
-- Name: service_type id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_type ALTER COLUMN id SET DEFAULT nextval('public.service_type_id_pkey'::regclass);


--
-- TOC entry 2330 (class 2604 OID 16661581)
-- Name: sh_list id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sh_list ALTER COLUMN id SET DEFAULT nextval('public.sh_list_id_seq'::regclass);


--
-- TOC entry 2332 (class 2604 OID 16661582)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 2334 (class 2604 OID 16661583)
-- Name: visitor id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visitor ALTER COLUMN id SET DEFAULT nextval('public.visitor_id_seq'::regclass);


--
-- TOC entry 2352 (class 2606 OID 16661585)
-- Name: activity_visitor_register activities_participants_register_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_visitor_register
    ADD CONSTRAINT activities_participants_register_pkey PRIMARY KEY (event, visitor_id);


--
-- TOC entry 2338 (class 2606 OID 16661587)
-- Name: activity_category activity_category_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_category
    ADD CONSTRAINT activity_category_key UNIQUE (name);


--
-- TOC entry 2340 (class 2606 OID 16661589)
-- Name: activity_category activity_category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_category
    ADD CONSTRAINT activity_category_pkey PRIMARY KEY (id);


--
-- TOC entry 2342 (class 2606 OID 16661591)
-- Name: activity_event activity_event_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_event
    ADD CONSTRAINT activity_event_pkey PRIMARY KEY (id);


--
-- TOC entry 2344 (class 2606 OID 16661593)
-- Name: activity_periodicity activity_periodicity_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_periodicity
    ADD CONSTRAINT activity_periodicity_pkey PRIMARY KEY (id);


--
-- TOC entry 2346 (class 2606 OID 16661595)
-- Name: activity_photo activity_photo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_photo
    ADD CONSTRAINT activity_photo_pkey PRIMARY KEY (id);


--
-- TOC entry 2336 (class 2606 OID 16661597)
-- Name: activity activity_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity
    ADD CONSTRAINT activity_pkey PRIMARY KEY (id);


--
-- TOC entry 2348 (class 2606 OID 16661599)
-- Name: activity_type activity_type_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_type
    ADD CONSTRAINT activity_type_name_key UNIQUE (name);


--
-- TOC entry 2350 (class 2606 OID 16661601)
-- Name: activity_type activity_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_type
    ADD CONSTRAINT activity_type_pkey PRIMARY KEY (id);


--
-- TOC entry 2357 (class 2606 OID 16661603)
-- Name: city_district agency_district_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_district
    ADD CONSTRAINT agency_district_id_pkey PRIMARY KEY (id);


--
-- TOC entry 2355 (class 2606 OID 16661605)
-- Name: agency agency_id_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agency
    ADD CONSTRAINT agency_id_pkey PRIMARY KEY (id);


--
-- TOC entry 2359 (class 2606 OID 16661607)
-- Name: agency_management agency_management_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agency_management
    ADD CONSTRAINT agency_management_pkey PRIMARY KEY (id);


--
-- TOC entry 2361 (class 2606 OID 16661609)
-- Name: agency_photo_album agency_photo_album_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agency_photo_album
    ADD CONSTRAINT agency_photo_album_pkey PRIMARY KEY (id);


--
-- TOC entry 2365 (class 2606 OID 16661611)
-- Name: city_activity_category city_activity_category_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_activity_category
    ADD CONSTRAINT city_activity_category_key UNIQUE (name);


--
-- TOC entry 2367 (class 2606 OID 16661613)
-- Name: city_activity_category city_activity_category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_activity_category
    ADD CONSTRAINT city_activity_category_pkey PRIMARY KEY (id);


--
-- TOC entry 2369 (class 2606 OID 16661615)
-- Name: city_activity_photo city_activity_photo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_activity_photo
    ADD CONSTRAINT city_activity_photo_pkey PRIMARY KEY (id);


--
-- TOC entry 2363 (class 2606 OID 16661617)
-- Name: city_activity city_activity_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_activity
    ADD CONSTRAINT city_activity_pkey PRIMARY KEY (id);


--
-- TOC entry 2372 (class 2606 OID 16661619)
-- Name: city_region city_region_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.city_region
    ADD CONSTRAINT city_region_pkey PRIMARY KEY (id);


--
-- TOC entry 2374 (class 2606 OID 16661621)
-- Name: department_management department_management_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.department_management
    ADD CONSTRAINT department_management_pkey PRIMARY KEY (id);


--
-- TOC entry 2378 (class 2606 OID 16661623)
-- Name: long_life_activity_category long_life_activity_category_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.long_life_activity_category
    ADD CONSTRAINT long_life_activity_category_key UNIQUE (name);


--
-- TOC entry 2380 (class 2606 OID 16661625)
-- Name: long_life_activity_category long_life_activity_category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.long_life_activity_category
    ADD CONSTRAINT long_life_activity_category_pkey PRIMARY KEY (id);


--
-- TOC entry 2382 (class 2606 OID 16661627)
-- Name: long_life_activity_photo long_life_activity_photo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.long_life_activity_photo
    ADD CONSTRAINT long_life_activity_photo_pkey PRIMARY KEY (id);


--
-- TOC entry 2376 (class 2606 OID 16661629)
-- Name: long_life_activity long_life_activity_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.long_life_activity
    ADD CONSTRAINT long_life_activity_pkey PRIMARY KEY (id);


--
-- TOC entry 2384 (class 2606 OID 16661631)
-- Name: screen_file screen_file_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.screen_file
    ADD CONSTRAINT screen_file_pkey PRIMARY KEY (id);


--
-- TOC entry 2387 (class 2606 OID 16661633)
-- Name: screen_saver screen_saver_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.screen_saver
    ADD CONSTRAINT screen_saver_pkey PRIMARY KEY (id);


--
-- TOC entry 2391 (class 2606 OID 16661635)
-- Name: service_category service_category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_category
    ADD CONSTRAINT service_category_pkey PRIMARY KEY (id);


--
-- TOC entry 2393 (class 2606 OID 16661637)
-- Name: service_chargeable_type service_chargeable_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_chargeable_type
    ADD CONSTRAINT service_chargeable_type_pkey PRIMARY KEY (id);


--
-- TOC entry 2395 (class 2606 OID 16661639)
-- Name: service_chargeable_type_to_service service_chargeable_type_to_service_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_chargeable_type_to_service
    ADD CONSTRAINT service_chargeable_type_to_service_pkey PRIMARY KEY (id);


--
-- TOC entry 2397 (class 2606 OID 16661641)
-- Name: service_location_type service_location_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_location_type
    ADD CONSTRAINT service_location_type_pkey PRIMARY KEY (id);


--
-- TOC entry 2389 (class 2606 OID 16661643)
-- Name: service service_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service
    ADD CONSTRAINT service_pkey PRIMARY KEY (id);


--
-- TOC entry 2399 (class 2606 OID 16661645)
-- Name: service_to_agency service_to_agency_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_to_agency
    ADD CONSTRAINT service_to_agency_pkey PRIMARY KEY (id);


--
-- TOC entry 2403 (class 2606 OID 16661647)
-- Name: service_tree service_tree_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_tree
    ADD CONSTRAINT service_tree_pkey PRIMARY KEY (ancestor, descendant);


--
-- TOC entry 2405 (class 2606 OID 16661649)
-- Name: service_type service_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.service_type
    ADD CONSTRAINT service_type_pkey PRIMARY KEY (id);


--
-- TOC entry 2407 (class 2606 OID 16661651)
-- Name: sh_list sh_list_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sh_list
    ADD CONSTRAINT sh_list_pkey PRIMARY KEY (id);


--
-- TOC entry 2409 (class 2606 OID 16661653)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 2411 (class 2606 OID 16661655)
-- Name: visitor visitor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visitor
    ADD CONSTRAINT visitor_pkey PRIMARY KEY (id);


--
-- TOC entry 2353 (class 1259 OID 16661656)
-- Name: agency_headagency_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX agency_headagency_id ON public.agency USING btree (headagency_id);


--
-- TOC entry 2370 (class 1259 OID 16661663)
-- Name: fki_city_activity_photo_activity_fkey; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_city_activity_photo_activity_fkey ON public.city_activity_photo USING btree (activity_id);


--
-- TOC entry 2385 (class 1259 OID 16661671)
-- Name: screen_file_screensaver_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX screen_file_screensaver_id ON public.screen_file USING btree (screensaver_id);


--
-- TOC entry 2400 (class 1259 OID 16661672)
-- Name: service_to_agency_service_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX service_to_agency_service_id ON public.service_to_agency USING btree (service_id, agency_id);


--
-- TOC entry 2401 (class 1259 OID 16661673)
-- Name: service_tree_path_length_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX service_tree_path_length_idx ON public.service_tree USING btree (length);


--
-- TOC entry 2533 (class 0 OID 0)
-- Dependencies: 7
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2018-12-19 18:20:34 MSK

--
-- PostgreSQL database dump complete
--

