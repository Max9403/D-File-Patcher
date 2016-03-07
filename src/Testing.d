import std.stdio;
import std.net.curl;
import std.utf;
import std.json;

void main() {
    writeln("POTATO");

    string json = toUTF8(get("127.0.0.1/files.php"));

    JSONValue jValue = parseJSON(json);

    writeln(jValue["CREDITS.txt"]);
}
