
import moment from "moment";

export function formatDate(date) {
    const messageDate = moment(date);

    if (messageDate.isSame(moment(), "day")) {
        return messageDate.format("h:mm A");
    }

    if (messageDate.isSame(moment().subtract(1, "day"), "day")) {
        return "Yesterday";
    }

    if (messageDate.isSame(moment(), "year")) {
        return messageDate.format("MMM DD") + " at " + messageDate.format("h:mm A");
    }

    return messageDate.format("MMM D, YYYY");
}

