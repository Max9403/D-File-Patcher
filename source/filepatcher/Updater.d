import std.net.curl;
import std.json;

class Updater {
    private static Updater _instance;

    protected this() {}

    public static Updater instance() {
        if (_instance is null) {
            _instance = new Updater();
        }
        return _instance;
    }

    public JSONValue getRemoteHashes(string url) {
        return parseJSON(get("127.0.0.1/files.php"));
    }
}
