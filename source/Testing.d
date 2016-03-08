import std.stdio;
import std.json;
import Updater : Updater;

void main() {
    writeln("Starting connection");

    JSONValue jValue = Updater.instance.getRemoteHashes("127.0.0.1/files.php");

    writeln(jValue["CREDITS.txt"]);
}
